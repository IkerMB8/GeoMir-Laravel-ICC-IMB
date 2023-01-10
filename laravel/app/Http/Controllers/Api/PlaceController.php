<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Favourite;
use App\Models\File;
use App\Models\Visibility;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $places = Place::withCount('favourites')->get();
        return response()->json([
            'success' => true,
            'data'    => $places
        ], 200);
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
            // Patró PRG amb missatge d'èxit
            return response()->json([
                'success' => true,
                'data'    => $place
            ], 201);
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error 
            return response()->json([
                'success'  => false,
                'errors' => ['Error uploading file']
            ], 421);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $place = Place::find($id);
        if ($place){
            return response()->json([
                'success' => true,
                'data'    => $place
            ], 200);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error place not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar fitxer
        $place = Place::find($id);
        if ($place){
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
                    return response()->json([
                        'success' => true,
                        'data'    => $place
                    ], 200);
                } else {
                    \Log::debug("Local storage FAILS");
                    // Patró PRG amb missatge d'error
                    return response()->json([
                        'success'  => false,
                        'errors' => ['Error uploading place']
                    ], 421);
                }
            }else{
                return response()->json([
                    'success'  => false,
                    'message' => "ERROR deleting place, you can't delete a posts that nots yours"
                ], 500);
            }
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error searching place'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $place = Place::find($id);
        if ($place){
            if ($place->user->id == auth()->user()->id || auth()->user()->hasRole(['admin'])){
                $file = $place->file;
                \Storage::disk('public')->delete($file->filepath);
                if (\Storage::disk('public')->exists($file->filepath)) {
                    return response()->json([
                        'success'  => false,
                        'message' => 'ERROR deleting place'
                    ], 500);
                } else {     
                    Place::destroy($place->id);
                    File::destroy($file->id);
                    return response()->json([
                        'success' => true,
                        'data'    => "Place successfully deleted"
                    ], 200);
                }
            }else{
                return response()->json([
                    'success'  => false,
                    'message' => "ERROR deleting place, you can't delete a posts that nots yours"
                ], 500);
            }
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error searching place'
            ], 404);
        }
    }
}
