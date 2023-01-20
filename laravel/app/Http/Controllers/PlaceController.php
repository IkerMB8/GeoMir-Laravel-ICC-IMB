<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Favourite;
use App\Models\File;
use App\Models\Visibility;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware(['auth','permission:places.create'])->only(['create','store']);
        $this->middleware(['auth','permission:places.read'])->only('show');
        $this->middleware(['auth','permission:places.update'])->only(['edit','update']);
        $this->middleware(['auth','permission:places.delete'])->only('destroy');
    }
    public function index()
    {
        //
        $places = Place::withCount('favourites')->get();
        return view("places.index", [
            "places" => $places,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("places.create", [
            "visibilities" => Visibility::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // Validar fitxer
        $validatedData = $request->validate([
            'pname' => 'required',
            'pdescription' => 'required',
            'platitude' => 'required|numeric',
            'plongitude' => 'required|numeric',
            'pcategory_id' => 'required|numeric',
            'pvisibility_id' => 'required|numeric',
            'pupload' => 'required|mimes:gif,jpeg,jpg,png|max:1024'
        ]);
    
        // Obtenir dades del fitxer
        $upload = $request->file('pupload');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();
        \Log::debug("Storing file '{$fileName}' ($fileSize)...");

        // Pujar fitxer al disc dur
        $uploadName = time() . '_' . $fileName;
        $filePath = $upload->storeAs(
            'uploads',      // Path
            $uploadName ,   // Filename
            'public'        // Disk
        );
    
        if (\Storage::disk('public')->exists($filePath)) {
            \Log::debug("Local storage OK");
            $fullPath = \Storage::disk('public')->path($filePath);
            \Log::debug("File saved at {$fullPath}");
            // Desar dades a BD
            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);
            \Log::debug("DB storage OK");
            $place = Place::create([
                'name' =>$request->input('pname'),
                'description' =>$request->input('pdescription'),
                'file_id' =>$file->id,
                'latitude' =>$request->input('platitude'),
                'longitude' =>$request->input('plongitude'),
                'category_id' =>$request->input('pcategory_id'),
                'visibility_id' =>$request->input('pvisibility_id'),
                'author_id' =>auth()->user()->id,
            ]);
            \Log::debug("DB storage OK");
            return redirect()->route('places.show', $place)
                ->with('success', __('fpp.place-successc'));
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("places.create")
                ->with('error', __('fpp.errorupl'));
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        //
        $place->loadCount('favourites');
        $visibility=Visibility::find($place->visibility_id);
        return view("places.show", [
            "place" => $place,
            "autor" => $place->user,
            "favourites" => $place->favourites_count,
            "visibility" => $visibility,
            "reviews"  =>  $place->reviews(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        //
        if ($place->user->id == auth()->user()->id){

            return view("places.edit", [
                "place" => $place,
                "autor" => $place->user,
                "visibilities" => Visibility::all(),
            ]);
        }else{
            return redirect()->route('places.show', $place)
            ->with('error', __('fpp.place-notproperty'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {
        // Validar fitxer
        $validatedData = $request->validate([
            'pcategory_id' => 'numeric',
            'pvisibility_id' => 'numeric',
            'pupload' => 'mimes:gif,jpeg,jpg,png|max:1024'
        ]);
        if ($place->user->id == auth()->user()->id){
            $file=$place->file;  
            // Obtenir dades del fitxer
            $upload = $request->file('pupload');
            $controlNull= FALSE;
            if (! is_null($upload)){
                $fileName = $upload->getClientOriginalName();
                $fileSize = $upload->getSize();
                \Log::debug("Storing file '{$fileName}' ($fileSize)...");
                // Pujar fitxer al disc dur
                $uploadName = time() . '_' . $fileName;
                $filePath = $upload->storeAs(
                    'uploads',      // Path
                    $uploadName ,   // Filename
                    'public'        // Disk
                );
            }else{
                $filePath=$file->filepath;
                $fileSize=$file->filesize;
                $controlNull= TRUE;
            }
            
            if (\Storage::disk('public')->exists($filePath)) {
                if ($controlNull == FALSE){
                    Storage::disk('public')->delete($file->filepath);
                    \Log::debug("Local storage OK");
                    $fullPath = \Storage::disk('public')->path($filePath);
                    \Log::debug("File saved at {$fullPath}");
                    $file->filepath=$filePath;
                    $file->filesize=$fileSize;
                    $file->save();
                    // Desar dades a BD
                    \Log::debug("DB storage OK");
                }
                
                if ($request->input('pname') != NULL){
                    $place->name=$request->input('pname');
                }
                if ($request->input('pdescription') != NULL){
                    $place->description=$request->input('pdescription');
                }
                if ($request->input('pvisibility_id') != NULL){
                    $place->visibility_id=$request->input('pvisibility_id');
                }
                $place->save();
                return redirect()->route('places.show', $place)
                ->with('success', __('fpp.place-successupd'));
            } else {
                \Log::debug("Local storage FAILS");
                // Patró PRG amb missatge d'error
                return redirect()->route("places.edit")
                    ->with('error', __('fpp.errorupl'));
            }
        }else{
            return redirect()->route('places.show', $place)
            ->with('error', __('fpp.place-notproperty'));
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        //
        if ($place->user->id == auth()->user()->id || auth()->user()->hasRole(['admin'])){
            $file = $place->file;
            \Storage::disk('public')->delete($file->filepath);
            if (\Storage::disk('public')->exists($file->filepath)) {
                return redirect()->route('places.show', $place)
                ->with('error', __('fpp.place-errordel'));
            } else {     
                Place::destroy($place->id);
                File::destroy($file->id);
                return redirect()->route('places.index', ["places" => Place::all()])
                ->with('success', __('fpp.place-successdel'));
            }
        }else{
            return redirect()->route('places.show', $place)
            ->with('error', __('fpp.place-notpropertydel'));
        }
    }

    public function favourite(Place $place){
        $favourite = Favourite::create([
            'user_id' => auth()->user()->id,
            'place_id' => $place->id,
        ]);
        return redirect()->back();
    }

    public function unfavourite(Place $place){
        Favourite::where('user_id',auth()->user()->id)
                 ->where('place_id', $place->id )->delete();
        return redirect()->route('places.show', $place);
    }

    public function review(Place $place, Request $request){
        $validatedData = $request->validate([
            'preview'   =>  'required',
            'estrellas' =>  'required',
        ]);
        if (Review::where('user_id',auth()->user()->id)->where('place_id', $place->id )->first()){
            return redirect()->route('places.show', $place)
            ->with('error', ("ERROR you can't review the same two times"));
        }else{
            $review = Review::create([
                'user_id'       =>  auth()->user()->id,
                'place_id'      =>  $place->id,
                'review'        =>  $request->input('preview'),
                'valoracion'    =>  $request->input('estrellas'),
            ]);
            return redirect()->back();
        }
    }

    public function unreview($id, Request  $request){
        $place = Place::find($id);
        $review = Review::find($request->input('id'));
        if ($place->user_id == auth()->user()->id || auth()->user()->hasRole(['admin']) || $review->user_id == auth()->user()->id ){
            $review->delete();
            return redirect()->route('places.show', $place)
                ->with('success', __('Review deleted succesfully'));
        }else{
            return redirect()->route('places.show', $place)
            ->with('error', ("ERROR you cannot delete a review that is not yours"));
        }
    }
}
