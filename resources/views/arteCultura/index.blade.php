@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <arte-cultura-component
                user="{{$user}}"
                arte_cultura="{{$arte_cultura}}">

                <div class="d-flex justify-content-center">
                    <div class="spinner-grow text-info">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </arte-cultura-component>
        </div>
    </div>
</div>


@endsection