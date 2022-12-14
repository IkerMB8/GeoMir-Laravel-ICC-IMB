<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\File;
use App\Models\Like;
use App\Models\Visibility;

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
        $posts = Post::withCount('likes')->get();
        return response()->json([
            'success' => true,
            'data'    => $posts
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
            'pbody'          => 'required',
            'platitude'      => 'required|numeric',
            'plongitude'     => 'required|numeric',
            'pvisibility_id' => 'required|numeric',
            'pupload'        => 'required|mimes:gif,jpeg,jpg,png|max:1024'
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
            $post = Post::create([
                'body' =>$request->input('pbody'),
                'file_id' =>$file->id,
                'latitude' =>$request->input('platitude'),
                'longitude' =>$request->input('plongitude'),
                'visibility_id' =>$request->input('pvisibility_id'),
                'author_id' =>auth()->user()->id,
            ]);
            \Log::debug("DB storage OK");
            return response()->json([
                'success' => true,
                'data'    => $post
            ], 201);
        } else {
            \Log::debug("Local storage FAILS");
            // Patr?? PRG amb missatge d'error
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
        $post = Post::find($id);
        if ($post){
            return response()->json([
                'success' => true,
                'data'    => $post
            ], 200);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error post not found'
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
        //
        // Validar fitxer
        $post = Post::find($id);
        if ($post){
            $validatedData = $request->validate([
                'pcatid' => 'numeric',
                'pvisibility_id' => 'numeric',
                'pupload' => 'mimes:gif,jpeg,jpg,png|max:1024'
            ]);
            
            if ($post->user->id == auth()->user()->id){
                $file=File::find($post->file_id);  
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
                    if ($request->input('pbody') != NULL){
                        $post->body=$request->input('pbody');
                    }
                    if ($request->input('pvisibility_id') != NULL){
                        $post->visibility_id=$request->input('pvisibility_id');
                    }
                    $post->save();
                    return response()->json([
                        'success' => true,
                        'data'    => $post
                    ], 200);
                } else {
                    \Log::debug("Local storage FAILS");
                    // Patr?? PRG amb missatge d'error
                    return response()->json([
                        'success'  => false,
                        'errors' => ['Error uploading post']
                    ], 421);
                }
            }else{
                return response()->json([
                    'success'  => false,
                    'message' => "ERROR deleting post, you can't delete a posts that nots yours"
                ], 500);
            }
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error searching post'
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
        $post = Post::find($id);
        if ($post){
            if ($post->user->id == auth()->user()->id || auth()->user()->hasRole(['admin'])){
                $file=File::find($post->file_id);   
                \Storage::disk('public')->delete($file->filepath);  
                if (\Storage::disk('public')->exists($file->filepath)) {
                    return response()->json([
                        'success'  => false,
                        'message' => 'ERROR deleting post'
                    ], 500);
                } else {
                    Post::destroy($post->id);
                    File::destroy($file->id);
                    return response()->json([
                        'success' => true,
                        'data'    => "Post successfully deleted"
                    ], 200);
                }
            }else{
                return response()->json([
                    'success'  => false,
                    'message' => "ERROR deleting Post, you can't delete a posts that nots yours"
                ], 500);
            }
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error searching Post'
            ], 404);
        }
    }
}
