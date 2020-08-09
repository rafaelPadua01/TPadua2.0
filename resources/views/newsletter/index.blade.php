@extends('layouts.app')

@section('content')
<div class="container-fluid">
     <div class="row">
     <div class="col-12">
            <newsletter-component 
                n_users_assing="{{$n_users_assing}}"
                user="{{$user}}"
                img_noticia = "{{$img_noticia}}"
                history="{{$history}}">
            <div class="d-flex justify-content-center">
                <div class="spinner-group text-info" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            </newsletter-component>
        </div>
    </div>
</div>
@endsection