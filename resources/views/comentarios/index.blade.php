@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <comentarios-component
                user = "{{ $user }}"
                comentarios = "{{ $comentarios}} "
                respostas = "{{ $respostas }}"
                denuncia = "{{ $denuncia }}"
                denuncia_r = "{{ $denuncia_r}}"
            >
               
                <div class='d-flex justify-center-content'>
                    <div class="spinner-grow text-info" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>

            </comentarios-component>

            
        </div>
    </div>
<div>


@endsection