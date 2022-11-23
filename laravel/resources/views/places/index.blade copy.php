@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{ __('Places') }}</div>
               <div class="card-body">
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
                                <td scope="col">{{ __('fields.author_id') }}</td>
                                <td scope="col">{{ __('fields.created') }}</td>
                                <td scope="col">{{ __('fields.lastupd') }}</td>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($places as $place)
                           <tr>
                                <td><a href="{{ route('places.show',$place) }}">{{ $place->id }}</a></td>
                                <td>{{ $place->name }}</td>
                                <td>{{ $place->description }}</td>
                                <td>{{ $place->file_id }}</td>
                                <td>{{ $place->latitude }}</td>
                                <td>{{ $place->longitude }}</td>
                                <td>{{ $place->category_id }}</td>
                                <td>{{ $place->visibility_id }}</td>
                                <td>{{ $place->author_id }}</td>
                                <td>{{ $place->created_at }}</td>
                                <td>{{ $place->updated_at }}</td>
                                @foreach ($files as $file)
                                    @if($file->id == $place->file_id)
                                        <td><img class="img-fluid" src='{{ asset("storage/{$file->filepath}") }}' style="display: block;margin: auto;"/></td>
                                    @endif
                                @endforeach
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
                   <a class="btn btn-primary" href="{{ route('places.create') }}" role="button">{{ __('fields.addplace') }}</a>
                   <a href="/dashboard" class="btn btn-secondary">{{ __('fields.goback') }}</a>

               </div>
           </div>
       </div>
   </div>
</div>
@endsection
