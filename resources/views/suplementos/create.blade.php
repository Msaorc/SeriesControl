@extends('layout')

@section('titulo')
    Suplementos    
@endsection

@section('cabecalho')
    Adicionar Suplementos
@endsection

@section('conteudo')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post">
        @csrf
        <div class="form-group">
            <div class="row">
                <div class="col col-8">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome">
                </div>
    
                <div class="col col-2">
                    <label for="nome">Tipo</label>
                    <input type="text" class="form-control" name="tipo_nome" id="tipo_nome">
                </div>
    
                <div class="col col-2">
                    <label for="nome">Objetivo</label>
                    <input type="text" class="form-control" name="objetivo_nome" id="objetivo_nome">
                </div>
            </div>
        </div>

        <button class="btn btn-primary">Adicionar</button>
    </form> 
@endsection
    