@extends('layouts.app')
@section('content')
    <div class="posts">
        @foreach ($places as $place)
            <div class="post">
                <div class="topp">
                    <div class="perf">
                        <img src="/img/obama.jpg"><p>@ {{ $place->user->name }}</p>
                    </div>
                    <div>
                        <h5>{{ $place->name }}</h5>
                    </div>
                </div>
                <div>
                    @foreach ($files as $file)
                        @if($file->id == $place->file_id)
                            <img class="imgpub" src='{{ asset("storage/{$file->filepath}") }}'/>
                        @endif
                    @endforeach   
                </div>
                <div class="funct">
                    <div style="float: left;">
                        <i class="fa-regular fa-2x heart fa-heart"></i>
                        <button type="button" class="comments" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $place->id }}">
                            <i class="fa-regular fa-comment"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop{{ $place->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="display:flex; justify-content: center;">
                            <div class="modal-content" style="display:flex; flex-direction:row; background-color: #1a1830; padding: 15px;">
                                <div name="izquierda" style="margin-right:0; padding-left:5px; padding-top:5px;">
                                    <div class="modal-body" style="padding:0px">
                                        @foreach ($files as $file)
                                            @if($file->id == $place->file_id)
                                                <img src='{{ asset("storage/{$file->filepath}") }}' width="800px" height="700px" style="border:2px solid black; border-radius: 25px;"></img>
                                            @endif
                                        @endforeach  
                                    </div>
                                </div>
                                <div name="derecha" style="width: 100%; margin-right: 10px;">
                                    <div class="modal-header">
                                        <img src="/img/obama.jpg" width="50px" height="50px" style="border-radius: 190px; border: 1px solid white;"></img>
                                        <h5 class="modal-title" id="staticBackdropLabel" style="color: white; margin-left:5px">@ {{ $place->user->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white; opacity:100%;"></button>
                                    </div>
                                    <hr style="width: 100%; height: 5px; background-color: black; margin:0;">
                                    <div style="height: 620px; display: flex; flex-direction: column; justify-content: space-between;">
                                        <div style="height:300px"></div>
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
                <div class="review">
                    <div>
                        <input class="prueba" type="textarea" maxlength="140" placeholder="Añade tu reseña"/>
                    </div>
                    <div>
                        <i class="fa-regular fa-2x fa-star"></i><i class="fa-regular fa-2x fa-star"></i><i class="fa-regular fa-2x fa-star"></i><i class="fa-regular fa-2x fa-star"></i><i class="fa-regular fa-2x fa-star"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
        @vite('resources/js/bootstrap.js')

    @endsection