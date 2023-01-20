@extends('layouts.app')
@section('content')
    <div class="posts">
            <div class="post">
                <div class="topp">
                    <div class="cajatopp">
                        <div class="perf">
                            <img src="/img/defaultuser.jpg"><p>@ {{ $place->user->name }}</p>
                        </div>
                    </div>
                    <div>
                        <h5>{{ $place->name }}</h5>
                    </div>
                </div>
                <div>
                    <img id="imgprev" class="imgpub" src='{{ asset("storage/{$place->file->filepath}") }}' onerror="this.onerror=null; this.src='/img/notfound.png'"/>
                </div>
                
                <div>
                    <form method="post" action="{{ route('places.update',$place) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
    
                        <table class="table" >
                            <tbody>
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
                                            <label for="pupload">{{ __('fields.file') }}</label>
                                            <input type="file" id="pupload" name="pupload" value="{{ $place->file->filepath }}">
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
                                            <label for="pcategory_id">{{ __('fields.category_id') }}</label>
                                            <input type="text" id="pcategory_id" name="pcategory_id" value="{{ $place->category_id }}" readonly>
                                        </td>
                                </tr>
                                <tr>
                                        
                                        <td>
                                            <label for="pvisibility_id">{{ __('fields.visibility_id') }}</label>
                                            <select name="pvisibility_id" id="pvisibility_id">
                                                @foreach ($visibilities as $visibility)
                                                    @if($visibility->id == $place->visibility_id)
                                                        <option selected  value="{{ $visibility->id }}">{{ $visibility->name }}</option>
                                                    @else
                                                        <option value="{{ $visibility->id }}">{{ $visibility->name }}</option>
                                                    @endif        
                                                @endforeach  
                                            </select>
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
    <script>
        const $archivo = document.querySelector("#pupload");
        const $imgprev = document.querySelector("#imgprev");
        $archivo.addEventListener("change", () => {
        const archivos = $archivo.files;
        if (!archivos || !archivos.length) {
            $imgprev.src = "";
            return;
        }
        const primerArchivo = archivos[0];
        const objectURL = URL.createObjectURL(primerArchivo);
        $imgprev.src = objectURL;
        });
    </script>
    @env(['local','development'])
        @vite('resources/js/bootstrap.js')
    @endenv
    @endsection
