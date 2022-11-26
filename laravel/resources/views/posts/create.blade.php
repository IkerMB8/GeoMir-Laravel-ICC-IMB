@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Crear Post</div>
               <div class="card-body">
                    <form method="post" id="create" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        @vite('resources/js/posts/create-post.js')
                        <table class="table">
                                <tbody>
                                    <tr>
                                        <td id="body">
                                            <label for="pbody">{{ __('fields.body') }}</label>
                                            <input type="text" id="pbody" name="pbody">
                                            <div class="error alert alert-danger alert-dismissible fade noshow"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td id="upload">
                                            <label for="pupload">{{ __('fields.file') }}</label>
                                            <input type="file" id="pupload" name="pupload">
                                            <div class="error alert alert-danger alert-dismissible fade noshow"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td id="latitude">
                                            <label for="platitude">{{ __('fields.latitude') }}</label>
                                            <input type="text" id="platitude" name="platitude">
                                            <div class="error alert alert-danger alert-dismissible fade noshow"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td id="longitude">
                                            <label for="plongitude">{{ __('fields.longitude') }}</label>
                                            <input type="text" id="plongitude" name="plongitude">
                                            <div class="error alert alert-danger alert-dismissible fade noshow"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td id="visibility_id">
                                            <label for="pvisibility_id">{{ __('fields.visibility_id') }}</label>
                                            <select name="pvisibility_id" id="pvisibility_id">
                                                @foreach ($visibilities as $visibility)
                                                    <option value="{{ $visibility->id }}">{{ $visibility->name }}</option>
                                                @endforeach  
                                            </select>
                                            <div class="error alert alert-danger alert-dismissible fade noshow"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <button type="submit" class="btn btn-primary">{{ __('fields.create') }}</button>
                        <button type="reset" class="btn btn-secondary">{{ __('fields.reset') }}</button>
                        <a href="/posts" class="btn btn-secondary">{{ __('fields.goback') }}</a>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection