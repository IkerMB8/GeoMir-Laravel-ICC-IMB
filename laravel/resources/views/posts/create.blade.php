@extends('layouts.app')
@section('content')
<div class="overlay active" id="overlayadd">
    <div class="popup addpopup active" id="popupadd">
    <div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a href="/posts/create"><button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Post</button></a>
  </li>
  <li class="nav-item" role="presentation">
  <a href="/places/create"><button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Places</button></a>
  </li>
</ul>
    <img style="width: 60%;height: 40%;border-radius: 30px;"src="/img/grandcanyon.jpeg" id="imgprev"/>
    <form method="post" id="create" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        @vite('resources/js/posts/create-post.js')
        <div style="display: flex;justify-content: center;align-items: center;padding-left: 20%;padding-right: 20%;">
            <table class="table" style="color:white;">
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
        </div>
        <button type="submit" class="boton aceptar">{{ __('fields.create') }}</button>
        <button type="reset" class="boton">{{ __('fields.reset') }}</button>
        <a href="/posts" class="boton">{{ __('fields.goback') }}</a>
    </form>
    </div>
</div>
@vite('resources/js/bootstrap.js')
@endsection