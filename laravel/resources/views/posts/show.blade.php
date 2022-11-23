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
                                    <td scope="col">{{ __('fields.body') }}</td>
                                    <td scope="col">{{ __('fields.file_id') }}</td>
                                    <td scope="col">{{ __('fields.latitude') }}</td>
                                    <td scope="col">{{ __('fields.longitude') }}</td>
                                    <td scope="col">{{ __('fields.visibility_id') }}</td>
                                    <td scope="col">{{ __('fields.author') }}</td>
                                    <td scope="col">{{ __('fields.created') }}</td>
                                    <td scope="col">{{ __('fields.lastupd') }}</td>
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
                        <button type="submit" class="btn btn-primary">{{ __('fields.delete') }}</button>
                        <a href="{{ route('posts.edit',$post) }}" class="btn btn-secondary">{{ __('fields.edit') }}</a>
                        <a href="/posts" class="btn btn-secondary">{{ __('fields.goback') }}</a>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection