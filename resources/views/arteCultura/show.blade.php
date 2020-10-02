@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <evento-component
                evento="{{ $evento }}">

                <div class="d-flex justify-content-center">
                    <div class="spinner-grow text-info">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </evento-component>
        </div>
    </div>
</div>


@endsection