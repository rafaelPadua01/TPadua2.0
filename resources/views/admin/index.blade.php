@extends('layouts.app')

@section('content')

<div>
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
        
            <admin-component 
                user="{{ $user }}"  
                comentarios = "{{ $comentarios }}"  
                respostas = " {{ $respostas}} "
                >
            <div class="d-flex justify-content-center">
                <div class="spinner-grow text-info"  role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                
            </div>
            </admin-component>
         </div>
    </div>
    </div>
</div>


@endsection