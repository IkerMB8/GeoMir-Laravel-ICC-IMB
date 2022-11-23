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
                                    <td scope="col">{{ __('fields.name') }}</td>
                                    <td scope="col">{{ __('fields.description') }}</td>
                                    <td scope="col">{{ __('fields.file_id') }}</td>
                                    <td scope="col">{{ __('fields.latitude') }}</td>
                                    <td scope="col">{{ __('fields.longitude') }}</td>
                                    <td scope="col">{{ __('fields.category_id') }}</td>
                                    <td scope="col">{{ __('fields.visibility_id') }}</td>
                                    <td scope="col">{{ __('fields.author') }}</td>
                                    <td scope="col">{{ __('fields.created') }}</td>
                                    <td scope="col">{{ __('fields.updated') }}</td>
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
                        <button type="submit" class="btn btn-primary">{{ __('fields.delete') }}</button>
                        <a href="{{ route('places.edit',$place) }}" class="btn btn-secondary">Edit</a>
                        <a href="/places" class="btn btn-secondary">{{ __('fields.goback') }}</a>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
