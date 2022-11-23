@extends('layouts.app')
@section('content')
    <div style="display:grid; justify-content:center; text-align:center;">
        @foreach ($places as $place)
            <div class="publ">
                <div class="profile">
                    <img src="/img/obama.jpg" style="margin-top:5px; width: 70px; height: 70px; border-radius: 160px; border: 1px solid black"><p style="font-weight: bold; margin-left:5px ;margin-top: 20px;">@ {{ $place->user->name }}</p>
                </div>
                <p class="ubic">{{ $place->name }}</p>
                <div style="margin-top:20px;">
                    @foreach ($files as $file)
                        @if($file->id == $place->file_id)
                            <img style="border: 1px solid black; width:90%; margin-bottom:30px;" src='{{ asset("storage/{$file->filepath}") }}' style="display: block;margin: auto;"/>
                        @endif
                    @endforeach                       
                </div>
            </div>
        @endforeach
    </div>
@endsection