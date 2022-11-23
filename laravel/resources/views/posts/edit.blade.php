@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">ID {{ $post->id }}</div>
               <div class="card-body" style="display: grid;justify-content: center;align-items:center;">
                    <img class="img-fluid" src='{{ asset("storage/{$file->filepath}") }}' style="display: block;margin: auto;" />
                    <form method="post" action="{{ route('posts.update',$post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
    
                        <table class="table" >
                            <tbody>
                                <tr>
                                        <td>
                                            <label for="pid">ID</label>
                                            <input type="text" id="pid" name="pid" value="{{ $post->id }}" readonly>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="pbody">{{ __('fields.body') }}</label>
                                            <input type="text" id="pbody" name="pbody" value="{{ $post->body }}">
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
                                            <input type="text" id="platitude" name="platitude" value="{{ $post->latitude }}" readonly>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="plongitude">{{ __('fields.longitude') }}</label>
                                            <input type="text" id="plongitude" name="plongitude" value="{{ $post->longitude }}" readonly>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="pvisid">{{ __('fields.visibility_id') }}</label>
                                            <input type="text" id="pvisid" name="pvisid" value="{{ $post->visibility_id }}" readonly>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="pautid">{{ __('fields.autor') }}</label>
                                            <input type="text" id="pautid" name="pautid" value="{{ $autor->name }}" readonly>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="pcreat">{{ __('fields.created') }}</label>
                                            <input type="text" id="pcreat" name="pcreat" value="{{ $post->created_at }}" readonly>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="pupd">{{ __('fields.lastupd') }}</label>
                                            <input type="text" id="pupd" name="pupd" value="{{ $post->updated_at }}" readonly>
                                        </td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="display: flex;justify-content: center;" >
                            <button type="submit" class="btn btn-primary" style="margin:5px;">{{ __('fields.edit') }}</button>
                            <a href="{{ route('posts.show',$post) }}" class="btn btn-secondary" style="margin:5px;">{{ __('fields.goback') }}</a>
                        </div>    
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
