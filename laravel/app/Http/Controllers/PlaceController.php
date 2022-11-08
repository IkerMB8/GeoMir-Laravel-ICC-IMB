<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view("places.index", [
            "places" => Place::all()
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
       return view("places.create");
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
            'pcatid' => 'required|numeric',
            'pvisid' => 'required|numeric',
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:1024'
        ]);
    
        // Obtenir dades del fitxer
        $upload = $request->file('upload');
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
                'category_id' =>$request->input('pcatid'),
                'visibility_id' =>$request->input('pvisid'),
                'author_id' =>auth()->user()->id,
            ]);
            \Log::debug("DB storage OK");
            return redirect()->route('places.show', $place)
                ->with('success', 'Place successfully saved');
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("places.create")
                ->with('error', 'ERROR uploading file');
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
        $file=File::find($place->file_id);
        return view("places.show", [
            "place" => $place,
            "file" => $file,
            "autor" => $place->user,
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
        $file=File::find($place->file_id);
        return view("places.edit", [
            "place" => $place,
            "file" => $file,
            "autor" => $place->user,
        ]);
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
            'upload' => 'mimes:gif,jpeg,jpg,png|max:1024'
        ]);
        $file=File::find($place->file_id);  
        // Obtenir dades del fitxer
        $upload = $request->file('upload');
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
            $place->name=$request->input('pname');
            $place->description=$request->input('pdescription');
            $place->save();
            return redirect()->route('places.show', $place)
            ->with('success', 'Place successfully updated');
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("places.edit")
                ->with('error', 'ERROR uploading file');
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
        $file=File::find($place->file_id);    
        \Storage::disk('public')->delete($file->filepath);
        if (\Storage::disk('public')->exists($file->filepath)) {
            return redirect()->route('places.show', $place)
            ->with('error', 'ERROR deleting file');
        } else {     
            Place::destroy($place->id);
            File::destroy($file->id);
            return redirect()->route('places.index', ["places" => Place::all()])
            ->with('success', 'Place successfully deleted');
        }
        
    }
}
