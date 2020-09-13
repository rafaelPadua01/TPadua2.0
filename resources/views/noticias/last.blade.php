@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <last-news-component 
                    last_news="{{ json_encode($last_news) }}"
                    categorias="{{ $categorias }}" 
                >
                    <div class="d-flex justify-content-center">
                        <div class="spinner-grow text-info" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </last-news-component>
            </div>
        </div>
    </div>
@endsection

