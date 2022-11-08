@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">ID {{ $place->id }}</div>
               <div class="card-body">
                    <img class="img-fluid" src='{{ asset("storage/{$file->filepath}") }}' style="display: block;margin: auto;"/>
                    <form method="post" action="{{ route('places.destroy',$place) }}" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <table class="table">
                            <thead>
                                <tr>
                                    <td scope="col">ID</td>
                                    <td scope="col">Name</td>
                                    <td scope="col">Description</td>
                                    <td scope="col">File_id</td>
                                    <td scope="col">Latitude</td>
                                    <td scope="col">Longitude</td>
                                    <td scope="col">Category_id</td>
                                    <td scope="col">Visibility_id</td>
                                    <td scope="col">Autor</td>
                                    <td scope="col">Created_at</td>
                                    <td scope="col">Updated_at</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $place->id }}</td>
                                    <td>{{ $place->name }}</td>
                                    <td>{{ $place->description }}</td>
                                    <td>{{ $place->file_id }}</td>
                                    <td>{{ $place->latitude }}</td>
                                    <td>{{ $place->longitude }}</td>
                                    <td>{{ $place->category_id }}</td>
                                    <td>{{ $place->visibility_id }}</td>
                                    <td>{{ $autor->name }}</td>
                                    <td>{{ $place->created_at }}</td>
                                    <td>{{ $place->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Borrar</button>
                        <a href="{{ route('places.edit',$place) }}" class="btn btn-secondary">Edit</a>
                        <a href="/places" class="btn btn-secondary">Atrás</a>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
