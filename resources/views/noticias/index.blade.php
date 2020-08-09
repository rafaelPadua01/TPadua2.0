@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
           
            <noticia-component noticias="{{ $noticias  }}" categorias="{{$categorias}}" user="{{$user}}">
               
            <div class="d-flex justify-content-center">
                <div class="spinner-grow text-info"  role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                
            </div>
            
            </noticia-component>
            <!---->
            
        </div>
    </div>
</div>

@endsection