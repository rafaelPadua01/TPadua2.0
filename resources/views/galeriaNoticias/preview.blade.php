@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
     <div class=col-12>
   
            <galeria-img-component imgs_galeria="{{$imgs_galeria}}" user="{{$user}}">
                <div class="d-flex justify-content-center">
                        <div class="spinner-grow text-info"  role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        
                    </div>
            </galeria-img-component>
         </div>
    </div>
</div>


@endsection