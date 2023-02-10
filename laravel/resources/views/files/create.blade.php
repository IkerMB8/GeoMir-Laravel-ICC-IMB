@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{ __('fields.cfile') }}</div>
               <div class="card-body">
                <form method="post" id="create" action="{{ route('files.store') }}" enctype="multipart/form-data">
                        @csrf
                        @env(['local','development'])
                            @vite('resources/js/files/create.js')
                        @endenv
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <label for="upload">{{ __('fields.file') }}:</label>
                                        <input type="file" class="form-control" name="upload"/>
                                        <div id="error" class="alert alert-danger alert-dismissible fade"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">{{ __('fields.create') }}</button>
                        <button type="reset" class="btn btn-secondary">{{ __('fields.reset') }}</button>
                        <a href="/files" class="btn btn-secondary">{{ __('fields.goback') }}</a>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
