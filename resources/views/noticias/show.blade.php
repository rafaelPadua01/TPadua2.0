@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <display-noticia-component 
                    noticia="{{ $noticia }}"
                    img="{{ $img }}"
                    comentarios = "{{ $comentarios }}"
                    respostas = "{{ $respostas }}"
                >
                    <div class="d-flex justify-content-center">
                        <div class="spinner-grow text-info" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </display-noticia-component>
            </div>
        </div>
    </div>
@endsection

