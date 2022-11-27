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
    <a href="/posts/create"><button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Posts</button></a>
  </li>
  <li class="nav-item" role="presentation">
  <a href="/places/create"><button class="nav-link active" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Places</button></a>
  </li>
</ul>
    <img style="width: 60%;height: 40%;border-radius: 30px;"src="/img/grandcanyon.jpeg" id="imgprev"/>
    <form method="post" id="create" action="{{ route('places.store') }}" enctype="multipart/form-data">
        @csrf
        @vite('resources/js/places/create-place.js')
        <div style="display: flex;justify-content: center;align-items: center;padding-left: 20%;padding-right: 20%;">
            <table class="table" style="color:white;">
                <tbody>
                    <tr>
                        <td id="name">
                            <label for="pname">{{ __('fields.name') }}</label>
                            <input type="text" id="pname" name="pname">
                            <div class="error alert alert-danger alert-dismissible fade noshow"></div>
                        </td>
                    </tr>
                    <tr>
                        <td id="description">
                            <label for="pdescription">{{ __('fields.description') }}</label>
                            <input type="text" id="pdescription" name="pdescription">
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
                            <input type="number" step="any" id="platitude" name="platitude">
                            <div class="error alert alert-danger alert-dismissible fade noshow"></div>
                        </td>
                    </tr>
                    <tr>
                        <td id="longitude">
                            <label for="plongitude">{{ __('fields.longitude') }}</label>
                            <input type="number" step="any" id="plongitude" name="plongitude">
                            <div class="error alert alert-danger alert-dismissible fade noshow"></div>
                        </td>
                    </tr>
                    <tr>
                        <td id="category_id">
                            <label for="pcategory_id">{{ __('fields.category_id') }}</label>
                            <input type="number" id="pcategory_id" name="pcategory_id" value="1">
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
        <a href="/places" class="boton">{{ __('fields.goback') }}</a>
    </form>
    </div>
</div>
@vite('resources/js/bootstrap.js')
@endsection