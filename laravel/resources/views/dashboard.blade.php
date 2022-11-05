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
        <div style="display:grid;justify-content:center;">
            <h2>{{ __('Resources') }}</h2>
            <br>
            <div>
                <a href="{{ url('/files') }}" class="btn btn-secondary">{{ __('Files') }}</a>
                <a href="{{ url('/places') }}"class="btn btn-secondary">{{ __('Places') }}</a>
                <a href="{{ url('/posts') }}"class="btn btn-secondary">{{ __('Posts') }}</a>
            </div>
        </div>
    @endsection

</x-app-layout>
