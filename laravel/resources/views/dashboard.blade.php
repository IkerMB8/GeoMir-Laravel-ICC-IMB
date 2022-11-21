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
            <h2 style="text-align:center;">{{ __('Resources') }}</h2>
            <br>
            <div style="justify-content:center; display:flex;">
                <div style="border: 4px solid black; border-radius: 10px; width:auto;">
                    <a href="{{ url('/posts') }}"class="boton">{{ __('Posts') }}</a>
                    <a href="{{ url('/places') }}"class="boton">{{ __('Lugares') }}</a>
                    <a href="#"class="boton">{{ __('Imágenes') }}</a>
                    <a href="#"class="boton">{{ __('Vídeos') }}</a>
                    <a href="#"class="boton">{{ __('Ordenar') }}</a>

                </div>
            </div>
            <div style="border: 4px solid black; margin-top: 50px; margin-left:25%;margin-right:25%; width: 50%; border-radius: 10px;">
                <div style="display:flex; align-items:center; margin-left:35px;">
                    <img src="/img/obama.jpg" style="margin-top:5px; width: 70px; height: 70px; border-radius: 160px; border: 1px solid black"><p style="font-weight: bold; margin-left:5px ;margin-top: 20px;">@TuNegritoKLK69</p>
                </div>
                <p style="float:left; margin-left:35px;">Grand Canyon, Arizona</p>
                <div style="margin-top:20px;">
                    <img src="/img/grandcanyon.jpeg" style="border: 1px solid black; width:90%; margin-bottom:30px;">
                </div>
            </div>
        </div>
    @endsection

</x-app-layout>
