@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">ID {{ $file->id }}</div>
               <div class="card-body">
                    <img class="img-fluid" src='{{ asset("storage/{$file->filepath}") }}' />
                    <form method="post" action="{{ route('files.destroy',$file) }}" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <table class="table">
                            <thead>
                                <tr>
                                    <td scope="col">ID</td>
                                    <td scope="col">{{ __('fields.filepath') }}</td>
                                    <td scope="col">{{ __('fields.filesize') }}</td>
                                    <td scope="col">{{ __('fields.created') }}</td>
                                    <td scope="col">{{ __('fields.lastupd') }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                        <td>{{ $file->id }}</td>
                                        <td>{{ $file->filepath }}</td>
                                        <td>{{ $file->filesize }}</td>
                                        <td>{{ $file->created_at }}</td>
                                        <td>{{ $file->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">{{ __('fields.delete') }}</button>
                        <a href="{{ route('files.edit',$file) }}" class="btn btn-secondary">{{ __('fields.edit') }}</a>
                        <a href="/files" class="btn btn-secondary">{{ __('fields.goback') }}</a>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
