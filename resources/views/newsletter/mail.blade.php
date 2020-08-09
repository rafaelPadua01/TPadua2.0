@extends('layouts.app')

@section('content')
<style>
    table{
        border: 1px solid #000;
        position: absolute;
        top: 50%;
        width: 100%;
        text-align: 'center';
    }
    .text-center {
        text-align: 'center';
        position: absolute;
        top: 50%;
        width: 100%;

    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <table>
                <thead>
                    <tr>
                        
                        <th></th>
                        <th style="background-color: #17a2b8; color: #fff"><h1>Nome do projeto</h1></th>
                        <th></th>
                        
                    </tr>
                </thead>
                
                
                    <tbody>
                        <tr>
                            <td style="background-color: #17a2b8; color: #fff;">
                                <div>
                                    <h4 style="font-size: 1.0rem; text-align: center">Arte e cultura</h4>
                                    <hr>
                                    <ul style="list-style: none">
                                        @foreach($eventos as $e)
                                        <li>
                                            <p style="font-size: 1.0rem"><b>{{$e->nome_evento}}</b></h5>
                                            <p style="font-size:0.7rem"><b>Data:</b> {{$e->data_evento}}</p>
                                            <p style="font-size:0.7rem"><b>Hora:</b> {{$e->hora_evento}}</p>
                                            <p style="font-size:0.7rem"><a href="#">Clique aqui...</a></p>
                                            <hr>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div> 
                            </td>
                            <td>
                                <div>
                                        <ul style="list-style: none">
                                            @foreach($images as $img)
                                                <li>         
                                                    <p><img style="width: 10rem; display: inline-block" src="{{$message->embed($img->nome_imagem)}}" alt="{{$img->nome_imagem}}"></p>
                                                </li>           
                                            @endforeach
                                           
                                        </ul>
                                    
                                    <h3>Ultimas Notícias</h3>
                                    <hr>
                                    <ul style="list-style: none"> 
                                    
                                    @foreach($noticias as $n)       
                                            <li>
                                            
                                                <div style="font-size: 0.8rem">
                                                <p><b>Titulo:</b> {{$n->titulo}}</p>
                                                
                                                <p><b>Data:</b>  {{$n->created_at}}</p>
                                                    <p><a href="#">clique aqui...</a></p>
                                                </div>
                                                <hr>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                               
                            </td>
                            <td style="background-color: #17a2b8; color: #fff">
                                <h5>Destaques</h5>
                                <hr>
                            </td>
                        </tr>
                    </tbody>
                    
                    
                    
            </table>        
           
        <table>
        <tbody>
            <thead>
                <tr>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="background-color: #17a2b8; color: #fff; width: 100%">
                        <div>
                            <h4 style="text-align: center">Footer</h4>
                        </div>
                    </td>
                           
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</div>


@endsection

