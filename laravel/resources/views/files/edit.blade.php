@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">ID {{ $file->id }}</div>
               <div class="card-body">
                    <img class="img-fluid" src='{{ asset("storage/{$file->filepath}") }}' />
                    <form method="post" action="{{ route('files.update',$file) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <table class="table">
                            <tbody>
                                <tr>
                                        <td>
                                            <label for="fid">ID</label>
                                            <input type="text" id="fid" name="fid" value="{{ $file->id }}" readonly>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="upload">{{ __('fields.file') }}:</label>
                                            <input type="file" class="form-control" name="upload"/>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="fsize">{{ __('fields.filesize') }}</label>
                                            <input type="text" id="fsize" name="fsize" value="{{ $file->filesize }}" readonly>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="fupdated">{{ __('fields.lastupd') }}</label>
                                            <input type="text" id="fupdated" name="fupdated" value="{{ $file->updated_at }}" readonly>
                                        </td>
                                </tr>
                                <tr>
                                        <td>
                                            <label for="fcreated">{{ __('fields.created') }}</label>
                                            <input type="text" id="fcreated" name="fcreated" value="{{ $file->created_at }}" readonly>
                                        </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">{{ __('fields.edit') }}</button>
                        <a href="{{ route('files.show',$file) }}" class="btn btn-secondary">{{ __('fields.goback') }}</a>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
