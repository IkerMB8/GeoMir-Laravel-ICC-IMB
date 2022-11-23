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
                                <td scope="col">{{ __('fields.body') }}</td>
                                <td scope="col">{{ __('fields.file_id') }}</td>
                                <td scope="col">{{ __('fields.latitude') }}</td>
                                <td scope="col">{{ __('fields.longitude') }}</td>
                                <td scope="col">{{ __('fields.visibility_id') }}</td>
                                <td scope="col">{{ __('fields.author_id') }}</td>
                                <td scope="col">{{ __('fields.created') }}</td>
                                <td scope="col">{{ __('fields.lastupd') }}</td>
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
                   <a class="btn btn-primary" href="{{ route('posts.create') }}" role="button">{{ __('fields.addpost') }}</a>
                   <a href="/dashboard" class="btn btn-secondary">{{ __('fields.goback') }}</a>

               </div>
           </div>
       </div>
   </div>
</div>
@endsection