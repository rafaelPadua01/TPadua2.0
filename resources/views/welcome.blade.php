@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
           
            <welcome-component 
                n_destaque="{{json_encode($n_destaque)}}" 
                f_noticias="{{$f_noticias}}"
                u_noticias="{{$u_noticias}}"
                categorias="{{$categorias}}"
                s_noticia="{{$s_noticia}}"
                eventos="{{$eventos}}"
                upload_img="{{$upload_img}}"
               >
               
            <div class="d-flex justify-content-center">
                <div class="spinner-grow text-info"  role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                
            </div>
            
            </welcome-component>
            <!---->
            
        </div>
    </div>
</div>

@endsection