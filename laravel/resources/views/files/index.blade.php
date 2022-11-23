@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{ __('Files') }}</div>
               <div class="card-body">
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
                           @foreach ($files as $file)
                           <tr>
                                <td><a href="{{ route('files.show',$file) }}">{{ $file->id }}</a></td>
                                <td>{{ $file->filepath }}</td>
                                <td>{{ $file->filesize }}</td>
                                <td>{{ $file->created_at }}</td>
                                <td>{{ $file->updated_at }}</td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
                   <a class="btn btn-primary" href="{{ route('files.create') }}" role="button">{{ __('fields.addfile') }}</a>
                   <a href="/dashboard" class="btn btn-secondary">{{ __('fields.goback') }}</a>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
