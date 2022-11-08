@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">ID {{ $post->id }}</div>
               <div class="card-body">
                    <img class="img-fluid" src='{{ asset("storage/{$file->filepath}") }}' style="display: block;margin: auto;"/>
                    <form method="post" action="{{ route('posts.destroy',$post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <table class="table">
                            <thead>
                                <tr>
                                    <td scope="col">ID</td>
                                    <td scope="col">Body</td>
                                    <td scope="col">File_id</td>
                                    <td scope="col">Latitude</td>
                                    <td scope="col">Longitude</td>
                                    <td scope="col">Visibility_id</td>
                                    <td scope="col">Autor</td>
                                    <td scope="col">Created_at</td>
                                    <td scope="col">Updated_at</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->body }}</td>
                                        <td>{{ $post->file_id }}</td>
                                        <td>{{ $post->latitude }}</td>
                                        <td>{{ $post->longitude }}</td>
                                        <td>{{ $post->visibility_id }}</td>
                                        <td>{{ $autor->name }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>{{ $post->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Borrar</button>
                        <a href="{{ route('posts.edit',$post) }}" class="btn btn-secondary">Edit</a>
                        <a href="/posts" class="btn btn-secondary">Atrás</a>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection