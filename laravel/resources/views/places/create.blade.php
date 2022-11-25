@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Crear Place</div>
               <div class="card-body">
                    <form method="post" id="create" action="{{ route('places.store') }}" enctype="multipart/form-data">
                        @csrf
                        @vite('resources/js/places/create-place.js')
                        <table class="table">
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
                        <button type="submit" class="btn btn-primary">{{ __('fields.create') }}</button>
                        <button type="reset" class="btn btn-secondary">{{ __('fields.reset') }}</button>
                        <a href="/places" class="btn btn-secondary">{{ __('fields.goback') }}</a>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
