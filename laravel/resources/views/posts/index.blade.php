@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{ __('Posts') }}</div>
               <div class="card-body">
                   <table class="table">
                       <thead>
                           <tr>
                               <td scope="col">ID</td>
                               <td scope="col">Body</td>
                               <td scope="col">File</td>
                               <td scope="col">Latitude</td>
                               <td scope="col">Longitude</td>
                               <td scope="col">Visibility</td>
                               <td scope="col">Author</td>
                               <td scope="col">Created</td>
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
                   <a class="btn btn-primary" href="{{ route('files.create') }}" role="button">Add new file</a>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
