@extends('layouts.app')
@section('content')
    <div class="posts">
        @foreach ($places as $place)
            <div class="post">
                <div class="topp">
                    <div class="cajatopp">
                        <div class="perf">
                            <img src="/img/defaultuser.jpg"><p>@ {{ $place->user->name }}</p>
                        </div>
                        
                        @hasanyrole('admin|author|editor')
                        <!-- 3 PUNTOS -->
                        <button type="button" class="cerrar3p" data-bs-toggle="modal" data-bs-target="#options{{ $place->id }}">
                            <div style="height: 24px; width: 24px;"><svg aria-label="Más opciones" class="_ab6-" color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 24 24" width="24"><circle cx="12" cy="12" r="1.5"></circle><circle cx="6" cy="12" r="1.5"></circle><circle cx="18" cy="12" r="1.5"></circle></svg></div>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" style="--bs-modal-width:40% !important;" id="options{{ $place->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered logreg">
                                <div class="modal3p tres_puntos">
                                    <form method="post" action="{{ route('places.destroy',$place) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <div><button class="btnIND"><span class="spanDelete">Eliminar</span></button></div>
                                    </form>
                                    <div><a href="{{ route('places.edit',$place) }}"><button class="btnIND">Editar</button></a></div>
                                    <div><button type="button" class="btnIND" data-bs-dismiss="modal" aria-label="Close">Cancelar</button></div>
                                </div>    
                            </div>
                        </div>
                        @endhasanyrole
                    </div>
                    <div>
                        <h5>{{ $place->name }}</h5>
                    </div>
                </div>
                <div>
                    <a href="{{ route('places.show',$place) }}"><img class="imgpub" src='{{ asset("storage/{$place->file->filepath}") }}' onerror="this.onerror=null; this.src='/img/notfound.png'"/></a>
                </div>
                @hasanyrole('admin|author|editor')
                <div class="funct">
                    <div class="functizq">
                        @include('partials.buttons-favourites')
                        <button type="button" class="comments" data-bs-toggle="modal" data-bs-target="#place{{ $place->id }}">
                            <i class="fa-regular fa-comment"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="place{{ $place->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered logreg">
                                <div class="modal-content modalcntnt">
                                    <div class="commentizq">
                                        <div class="modal-body">
                                            <img class="commentimg" src='{{ asset("storage/{$place->file->filepath}") }}' onerror="this.onerror=null; this.src='/img/notfound.png'"></img></a>
                                        </div>
                                    </div>
                                    <div class="derecha">
                                        <div class="modal-header">
                                            <img src="/img/defaultuser.jpg" class="commentprofimg"></img>
                                            <h5 class="modal-title commentprofname" id="staticBackdropLabel">@ {{ $place->user->name }}</h5>
                                            <button type="button" class="btn-close buttonclose" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <hr>
                                        <div class="comentarios">
                                            @foreach ($place->reviews() as $review)
                                                <div class="caja_comment">
                                                    <p style="color:white;">@ {{ $review->reviewAuthor() }}</p>
                                                    <div class="comment_del">
                                                        <p style="color:white;">{{ $review->review }}</p>
                                                        @include('partials.buttons-delete-review')
                                                    </div>
                                                    <div style="display: flex;margin-top: 5px;">
                                                        @for ($val = 0; $val < $review->valoracion; $val++)
                                                            <i class="fa-solid fa-star" style="color:yellow; margin:0;"></i>
                                                        @endfor
                                                        @for ($no = 0; $no < (5-$review->valoracion); $no++)
                                                            <i class="fa-solid fa-star" style="color:white; margin:0;"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="derechader">
                                            <div></div>
                                            <div class="modal-footer comentario">
                                                <div style="float:left; width:100%;">
                                                    @include('partials.formreview')
                                                </div>          
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <i class="fa-solid fa-2x comment fa-share-from-square"></i>
                    </div>
                    <div class="functder">
                        <i class="fa-regular fa-2x fa-flag"></i>                    
                    </div>
                </div>
                @endhasanyrole
                <div>
                    @if( $place->favourites_count == 1 )
                        <p>{{ $place->favourites_count }} fav</p>
                    @else
                        <p>{{ $place->favourites_count }} favs</p>
                    @endif
                    <p>{{ $place->description }}</p>
                </div>
                <div class="review">
                    <div>
                        <p></p>
                    </div>
                    <div>
                        @for ($val = 0; $val < $place->valTtlReview(); $val++)
                            <i class="fa-solid fa-star" style="color:yellow; margin:0;"></i>
                        @endfor
                        @for ($no = 0; $no < (5-$place->valTtlReview()); $no++)
                            <i class="fa-solid fa-star" style="color:black; margin:0;"></i>
                        @endfor
                    </div>
                </div>
            </div>
            <br>
            <br>
        @endforeach
    </div>
    @env(['local','development'])
        @vite('resources/js/bootstrap.js')
    @endenv
    @endsection