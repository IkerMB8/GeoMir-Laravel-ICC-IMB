@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Crear Place</div>
               <div class="card-body">
                    <form method="post" action="{{ route('places.store') }}" enctype="multipart/form-data">
                        @csrf
                        <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <label for="pname">{{ __('fields.name') }}</label>
                                            <input type="text" id="pname" name="pname" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="pdescription">{{ __('fields.description') }}</label>
                                            <input type="text" id="pdescription" name="pdescription" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="upload">{{ __('fields.file') }}</label>
                                            <input type="file" id="upload" name="upload" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="platitude">{{ __('fields.latitude') }}</label>
                                            <input type="number" step="any" id="platitude" name="platitude" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="plongitude">{{ __('fields.longitude') }}</label>
                                            <input type="number" step="any" id="plongitude" name="plongitude" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="pcatid">{{ __('fields.category_id') }}</label>
                                            <input type="number" id="pcatid" name="pcatid" value="1" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="pvisid">{{ __('fields.visibility_id') }}</label>
                                            <select name="pvisid" id="pvisid">
                                                @foreach ($visibilities as $visibility)
                                                    <option value="{{ $visibility->id }}">{{ $visibility->name }}</option>
                                                @endforeach  
                                            </select>
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
