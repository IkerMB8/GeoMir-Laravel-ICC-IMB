@extends('layouts.app')
@section('content')
    <div class="posts">
        @foreach ($posts as $post)
            <div class="post">
                <div class="topp">
                    <div class="cajatopp">
                        <div class="perf">
                            <img src="/img/defaultuser.jpg"><p>@ {{ $post->user->name }}</p>
                        </div>
                    <!-- 3 PUNTOS -->
                    @hasanyrole('admin|author|editor')
                        <button type="button" class="cerrar3p" data-bs-toggle="modal" data-bs-target="#options{{ $post->id }}">
                            <div style="height: 24px; width: 24px;"><svg aria-label="Más opciones" class="_ab6-" color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 24 24" width="24"><circle cx="12" cy="12" r="1.5"></circle><circle cx="6" cy="12" r="1.5"></circle><circle cx="18" cy="12" r="1.5"></circle></svg></div>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" style="--bs-modal-width:40% !important;" id="options{{ $post->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered logreg">
                                <div class="modal3p modal-content">
                                <form method="post" action="{{ route('posts.destroy',$post) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <div><button class="btnIND"><span class="spanDelete">Eliminar</span></button></div>
                                </form>
                                    <div><a href="{{ route('posts.edit',$post) }}"><button class="btnIND">Editar</button></a></div>
                                    <div><button type="button" class="btnIND" data-bs-dismiss="modal" aria-label="Close">Cancelar</button></div>
                                </div>
                            </div>
                        </div>
                    @endhasanyrole
                </div>
                <div>
                    <h5>{{ $post->body }}</h5>
                </div>
            </div>
            <div>
                <a href="{{ route('posts.show',$post) }}"><img class="imgpub" src='{{ asset("storage/{$post->file->filepath}") }}' onerror="this.onerror=null; this.src='/img/notfound.png'"/></a>
            </div>
            
            @hasanyrole('admin|author|editor')
            <div class="funct">
                <div class="functizq">
                        @include('partials.buttons-likes')
                    
                        <button type="button" class="comments" data-bs-toggle="modal" data-bs-target="#post{{ $post->id }}">
                            <i class="fa-regular fa-comment"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="post{{ $post->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered logreg">
                                <div class="modal-content modalcntnt">
                                    <div class="commentizq">
                                        <div class="modal-body">
                                            <img class="commentimg" src='{{ asset("storage/{$post->file->filepath}") }}' onerror="this.onerror=null; this.src='/img/notfound.png'"></img></a>
                                        </div>
                                    </div>
                                    <div class="derecha">
                                        <div class="modal-header">
                                            <img src="/img/defaultuser.jpg" class="commentprofimg"></img>
                                            <h5 class="modal-title commentprofname" id="staticBackdropLabel">@ {{ $post->user->name }}</h5>
                                            <button type="button" class="btn-close buttonclose" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <hr>
                                        <div class="comentarios">
                                            @foreach ($post->comments() as $comment)
                                                <div class="caja_comment">
                                                    <p style="color:white;">@ {{ $comment->commentedBy() }}</p>
                                                    <div class="comment_del">
                                                        <p style="color:white;">{{ $comment->comment }}</p>
                                                        @include('partials.buttons-delete')
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="derechader">
                                            <div></div>
                                            <div class="modal-footer comentario">
                                                <div style="float:left;">
                                                    <form method="POST" action="{{ route('posts.comment',$post) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <input id="pcomment" name="pcomment" style="border:0; float:left;" type="textarea" maxlength="140" placeholder="Escriba aquí su comentario"/>
                                                        <button type="submit" class="botonpub" style="padding: 10px; background-color: #7000ff; color:white; border-radius:15px;">Publicar</button>
                                                    </form>
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
                    <i class="fa-regular fa-2x fa-flag"></i>                    
                </div>
            </div>
            @endhasanyrole
            <div>
                @if($post->likes_count == 1)
                    <p>{{ $post->likes_count }} like</p>
                @else
                    <p>{{ $post->likes_count }} likes</p>
                @endif
            </div>
        </div>
        
        <br><br><br>
    @endforeach
</div>
@env(['local','development'])
    @vite('resources/js/bootstrap.js')
@endenv
@endsection