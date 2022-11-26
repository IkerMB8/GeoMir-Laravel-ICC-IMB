@extends('layouts.app')
@section('content')
    <div class="posts">
        @foreach ($posts as $post)
            <div class="post">
                <div class="topp">
                    <div class="perf">
                        <img src="/img/defaultuser.jpg"><p>@ {{ $post->user->name }}</p>
                    </div>
                </div>
                <div>
                    @foreach ($files as $file)
                        @if($file->id == $post->file_id)
                            <img class="imgpub" src='{{ asset("storage/{$file->filepath}") }}'/>
                        @endif
                    @endforeach   
                </div>
                <div class="funct">
                    <div style="float: left;">
                        <i class="fa-regular fa-2x heart fa-heart"></i>
                        <button type="button" class="comments" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $post->id }}">
                            <i class="fa-regular fa-comment"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop{{ $post->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered logreg">
                                <div class="modal-content modalcntnt">
                                    <div class="commentizq">
                                        <div class="modal-body">
                                            @foreach ($files as $file)
                                                @if($file->id == $post->file_id)
                                                    <img class="commentimg" src='{{ asset("storage/{$file->filepath}") }}'></img>
                                                @endif
                                            @endforeach  
                                        </div>
                                    </div>
                                    <div name="derecha" style="width: 100%;">
                                        <div class="modal-header">
                                            <img src="/img/defaultuser.jpg" class="commentprofimg"></img>
                                            <h5 class="modal-title commentprofname" id="staticBackdropLabel">@ {{ $post->user->name }}</h5>
                                            <button type="button" class="btn-close buttonclose" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <hr>
                                        <div class="derechader">
                                            <div></div>
                                            <div class="modal-footer" style="margin-left:10px; border: 2px solid black;background-color: white;border-radius: 25px; display:flex; justify-content: space-between; ">
                                                <div style="float:left;">
                                                    <form>
                                                        <input style="border:0; float:left;" type="textarea" maxlength="140" placeholder="Escriba aquí su comentario"/>
                                                    </form>
                                                </div>
                                                <div style="float:right;">
                                                    <button type="button" style="padding: 10px; background-color: #7000ff; color:white; border-radius:15px;">Publicar</button>
                                                </div>         
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <i class="fa-solid fa-2x comment fa-share-from-square"></i>
                    </div>
                    <div style="float: right; margin-top:10px;">
                        <i class="fa-regular fa-2x fa-star"></i>
                        <i class="fa-regular fa-2x fa-flag"></i>                    
                    </div>
                </div>
                <div>
                    <p>0 likes</p>
                </div>
                <div>
                    <p>{{ $post->body }}</p>
                </div>
            </div>
        @endforeach
    </div>
        @vite('resources/js/bootstrap.js')

    @endsection