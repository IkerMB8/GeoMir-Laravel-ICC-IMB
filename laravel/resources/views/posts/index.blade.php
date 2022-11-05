@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{ __('Posts') }}</div>
               <div class="card-body">
                   <table class="table">
                       <thead>
                           <tr>
                                <td scope="col">ID</td>
                                <td scope="col">Body</td>
                                <td scope="col">File_id</td>
                                <td scope="col">Latitude</td>
                                <td scope="col">Longitude</td>
                                <td scope="col">Visibility_id</td>
                                <td scope="col">Author_id</td>
                                <td scope="col">Created_at</td>
                                <td scope="col">Updated_at</td>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($posts as $post)
                           <tr>
                                <td><a href="{{ route('posts.show',$post) }}">{{ $post->id }}</a></td>
                                <td>{{ $post->body }}</td>
                                <td>{{ $post->file_id }}</td>
                                <td>{{ $post->latitude }}</td>
                                <td>{{ $post->longitude }}</td>
                                <td>{{ $post->visibility_id }}</td>
                                <td>{{ $post->author_id }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->updated_at }}</td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
                   <a class="btn btn-primary" href="{{ route('posts.create') }}" role="button">Add new post</a>
                   <a href="/dashboard" class="btn btn-secondary">Volver</a>

               </div>
           </div>
       </div>
   </div>
</div>
@endsection