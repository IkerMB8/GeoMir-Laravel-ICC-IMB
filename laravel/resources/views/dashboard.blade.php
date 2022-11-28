<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
    @section('content')
        <div style="display:grid; justify-content:center; text-align:center;">
            <div style="border: 4px solid black; margin-top: 50px; margin-left:25%;margin-right:25%; width: 50%; border-radius: 10px;">
                <div style="display:flex; align-items:center; margin-left:35px;">
                    <img src="/img/obama.jpg" style="margin-top:5px; width: 70px; height: 70px; border-radius: 160px; border: 1px solid black"><p style="font-weight: bold; margin-left:5px ;margin-top: 20px;">@TuNegritoKLK69</p>
                </div>
                <p style="float:left; margin-top: 2px; margin-left:35px;">Grand Canyon, Arizona</p>
                <div style="margin-top:10px;">
                    <img src="/img/grandcanyon.jpeg" style="border: 2px solid black; width:90%;">
                </div>
                <div style="margin-top: 8px; margin-left: 35px; margin-right: 30px;">
                    <div style="float: left; margin-top:-10px;">
                        <i class="fa-regular fa-2x heart fa-heart"></i>
                        <button type="button" style="color:#1a1830; padding:0px; border:0px; background-color:white; font-size: 30px" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="fa-regular fa-comment"></i>
                        </button>
            
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="display:flex; justify-content: center;">
                            <div class="modal-content" style="display:flex; flex-direction:row; background-color: #1a1830; padding: 15px;">
                                <div name="izquierda" style="margin-right:0; padding-left:5px; padding-top:5px;">
                                    <div class="modal-body" style="padding:0px">
                                        <img src="/img/cr7.jpg" width="800px" height="700px" style="border:2px solid black; border-radius: 25px;"></img>
                                    </div>
                                </div>
                                <div name="derecha" style="width: 100%; margin-right: 10px;">
                                    <div class="modal-header">
                                        <img src="/img/obama.jpg" width="50px" height="50px" style="border-radius: 190px; border: 1px solid white;"></img>
                                        <h5 class="modal-title" id="staticBackdropLabel" style="color: white; margin-left:5px">@ikerc</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background-color: white; opacity:100%;"></button>
                                    </div>
                                    <hr style="width: 100%; height: 5px; background-color: black; margin:0;">
                                    <div style="height: 620px; display: flex; flex-direction: column; justify-content: space-between;">
                                        <div style="height:300px"></div>
                                            <div class="modal-footer" style="margin-left:10px; border: 2px solid black;background-color: white;border-radius: 25px; display:flex; justify-content: space-between; ">
                                                <div style="float:left; width:80%;">
                                                    <form>
                                                        <input style="border:0; float:left; width:80%;" type="textarea" maxlength="140" placeholder="Escriba aquí su comentario"/>
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
                    <div style="float: right;">
                        <i class="fa-regular fa-2x fa-star"></i>
                        <i class="fa-regular fa-2x fa-flag"></i>                    
                    </div>
                </div>
                <br>
                <br>
                <div style="float: left; width:100%;">
                    <p style="float:left; margin-left: 35px">0 likes</p>
                </div>
                <div style="border-radius: 25px; border: 2px solid #1a1830; width:90%;margin-bottom:10px; float: left; margin-left: 35px; display:flex; justify-content:center; align-text:center; padding:5px;">
                    <div style="border-radius:25px; border:0; float:left; width:60%; margin-left:5px; display:flex;align-items:center;">
                        <input style="border:0; float:left; width:60%;" type="textarea" maxlength="140" placeholder="Añade tu reseña"/>
                    </div>
                    <div>
                        <i class="fa-regular fa-2x fa-star"></i><i class="fa-regular fa-2x fa-star"></i><i class="fa-regular fa-2x fa-star"></i><i class="fa-regular fa-2x fa-star"></i><i class="fa-regular fa-2x fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
        
        @vite('resources/js/bootstrap.js')

    @endsection


</x-app-layout>
