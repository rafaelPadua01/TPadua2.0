@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <galeria-video-component
                v-bind:videos_galeria = "{{ json_encode($videos_galeria) }}"
                v-bind:user = "{{ json_encode($user) }}" 
            >
                <div class='d-flex justify-content-center'>
                    <div class="spinner-grow text-info" role='status'>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </galeria-video-component>
        </div>
    </div>
</div>


@endsection
