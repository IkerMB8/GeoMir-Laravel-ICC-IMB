<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\File;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("posts.index", [
            "posts" => Post::all()
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
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar fitxer
        $validatedData = $request->validate([
            'pbody' => 'required',
            'platitude' => 'required',
            'plongitude' => 'required',
            'pvisid' => 'required',
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
            $post = Post::create([
                'body' =>$request->input('pbody'),
                'file_id' =>$file->id,
                'latitude' =>$request->input('platitude'),
                'longitude' =>$request->input('plongitude'),
                'visibility_id' =>$request->input('pvisid'),
                'author_id' =>auth()->user()->id,
            ]);
            \Log::debug("DB storage OK");
            return redirect()->route('posts.show', $post)
                ->with('success', 'Post successfully saved');
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("posts.create")
                ->with('error', 'ERROR uploading file');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        $file=File::find($post->file_id);
        return view("posts.show", [
            "post" => $post,
            "file" => $file,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $file=File::find($post->file_id);
        return view("posts.edit", [
            "post" => $post,
            "file" => $file,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // Validar fitxer
        $validatedData = $request->validate([
            'upload' => 'mimes:gif,jpeg,jpg,png|max:1024'
        ]);
        $file=File::find($post->file_id);  
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
                \Storage::disk('public')->delete($file->filepath);
                \Log::debug("Local storage OK");
                $fullPath = \Storage::disk('public')->path($filePath);
                \Log::debug("File saved at {$fullPath}");
                $file->filepath=$filePath;
                $file->filesize=$fileSize;
                $file->save();
                // Desar dades a BD
                \Log::debug("DB storage OK");
            }
            $post->body=$request->input('pbody');
            $post->save();
            return redirect()->route('posts.show', $post)
            ->with('success', 'Post successfully updated');
        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("posts.edit")
                ->with('error', 'ERROR uploading file');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $file=File::find($post->file_id);     
        if (\Storage::disk('public')->exists($file->filepath)) {
            Post::destroy($post->id);
            File::destroy($file->id);
            \Storage::disk('public')->delete($file->filepath);
            return redirect()->route('posts.index', ["posts" => Post::all()])
            ->with('success', 'Post successfully deleted');
        } else {
            return redirect()->route('posts.show', $post)
            ->with('error', 'ERROR deleting file');
        }
    }
}