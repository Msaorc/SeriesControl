@extends('layout')

@section('titulo')
    Tipos
@endsection

@section('cabecalho')
    Tipo do Suplemento {{$suplemento->id}}
@endsection

@section('conteudo')
    <ul class="list-group">
        @foreach ($tipos as $tipo)
            <li class="list-group-item">
                {{ $tipo->nome }}
            </li>   
        @endforeach
    </ul>
@endsection

