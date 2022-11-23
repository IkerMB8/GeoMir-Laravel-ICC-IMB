@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">ID {{ $place->id }}</div>
               <div class="card-body" style="display: grid;justify-content: center;align-items:center;">
                    <img class="img-fluid" src='{{ asset("storage/{$file->filepath}") }}' style="display: block;margin: auto;" />
                    <form method="post" action="{{ route('places.update',$place) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
    
                        <table class="table" >
                            <tbody>
                                <tr>
                                        <td>
                                            <label for="pid">ID</label>
                                            <input type="text" id="pid" name="pid" value="{{ $place->id }}" readonly>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="pname">{{ __('fields.name') }}</label>
                                            <input type="text" id="pname" name="pname" value="{{ $place->name }}">
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="pdescription">{{ __('fields.description') }}</label>
                                            <input type="text" id="pdescription" name="pdescription" value="{{ $place->description }}">
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="upload">{{ __('fields.file') }}</label>
                                            <input type="file" id="upload" name="upload" value="{{ $file->filepath }}">
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="platitude">{{ __('fields.latitude') }}</label>
                                            <input type="text" id="platitude" name="platitude" value="{{ $place->latitude }}" readonly>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="plongitude">{{ __('fields.longitude') }}</label>
                                            <input type="text" id="plongitude" name="plongitude" value="{{ $place->longitude }}" readonly>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="pcatid">{{ __('fields.category_id') }}</label>
                                            <input type="text" id="pcatid" name="pcatid" value="{{ $place->category_id }}" readonly>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="pvisid">{{ __('fields.visibility_id') }}</label>
                                            <select name="pvisid" id="pvisid">
                                                <option value="1">Public</option>
                                                <option value="2">Contacts</option>
                                                <option value="3">Private</option>
                                            </select>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="pautid">{{ __('fields.author_id') }}</label>
                                            <input type="text" id="pautid" name="pautid" value="{{ $autor->name }}" readonly>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="pcreat">{{ __('fields.created') }}</label>
                                            <input type="text" id="pcreat" name="pcreat" value="{{ $place->created_at }}" readonly>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="pupd">{{ __('fields.lastupd') }}</label>
                                            <input type="text" id="pupd" name="pupd" value="{{ $place->updated_at }}" readonly>
                                        </td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="display: flex;justify-content: center;" >
                            <button type="submit" class="btn btn-primary" style="margin:5px;">{{ __('fields.edit') }}</button>
                            <a href="{{ route('places.show',$place) }}" class="btn btn-secondary" style="margin:5px;">{{ __('fields.goback') }}</a>
                        </div>    
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
