@extends('layouts.app')
@section('content')
    <div style="display:grid; justify-content:center; text-align:center;">
        @foreach ($posts as $post)
            <div class="publ" >
                <div style="display:flex; align-items:center; margin-left:35px;">
                    <img src="/img/obama.jpg" style="margin-top:5px; width: 70px; height: 70px; border-radius: 160px; border: 1px solid black"><p style="font-weight: bold; margin-left:5px ;margin-top: 20px;">@ {{ $post->user->name }}</p>
                </div>
                <p style="float:left; margin-left:35px;">{{ $post->body }}</p>
                <div style="margin-top:20px;">
                    @foreach ($files as $file)
                        @if($file->id == $post->file_id)
                            <img class="imgpubl" src='{{ asset("storage/{$file->filepath}") }}'/>
                        @endif
                    @endforeach                       
                </div>
            </div>
        @endforeach
    </div>
@endsection