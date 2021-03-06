@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <galerianoticias-component
                images="{{ $images }}"
                user="{{ $user }}"
                galerias="{{$galerias}}"
                noticias="{{$noticias}}"
                dir_galerias="{{json_encode($dir_galerias)}}"
                v-bind:videos="{{ json_encode($videos) }}"
                dir_videos = "{{ json_encode($dir_videos) }}"
                v-bind:galeria_videos = "{{ json_encode($galeria_videos) }}"
            >
                <div class="d-flex justify-content-center">
                    <div class="spinner-grow text-info"  role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </galerianoticias-component>
        </div>
    </div>
</div>


@endsection
