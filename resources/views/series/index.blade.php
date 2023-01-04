@extends('layout')

@section('titulo')
    Series
@endsection

@section('cabecalho')
    Series    
@endsection

@section('conteudo')
    @include('mensagem', ['mensagem' => $message])

    @auth
        <a href="{{route('form_adicionar_series')}}" class="btn btn-dark mb-2">Adicionar</a>        
    @endauth
    
    <ul class="list-group">
        @foreach ($listaSeries as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>
                <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                    <input type="text" class="form-control" value="{{ $serie->nome }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>

                <span class="d-flex">
                    @auth
                        <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $serie->id }})">
                            <i class="fas fa-edit"></i>
                        </button>
                    @endauth
                    <a href="/series/{{$serie->id}}/temporadas" class="btn btn-info btn-sm mr-1">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    @auth
                        <form action="/series/remover/{{$serie->id}}" method="post" 
                            onsubmit="return confirm('Tem certeza que deseja excluir {{ addslashes($serie->nome)}}?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    @endauth
                </span>
            </li>
        @endforeach
    </ul>

    <script>
        function toggleInput(serieId) {
            const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`);
            const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);
            if (nomeSerieEl.hasAttribute('hidden')) {
                nomeSerieEl.removeAttribute('hidden');
                inputSerieEl.hidden = true;
            } else {
                inputSerieEl.removeAttribute('hidden');
                nomeSerieEl.hidden = true;
            }
        }

        function editarSerie(serieID){
            let formData = new FormData();
            const valor = document.querySelector(`#input-nome-serie-${serieID} > input`).value;
            const token = document.querySelector('input[name="_token"]').value;
            formData.append('nome', valor);
            formData.append('_token', token);            
            const url = `/series/${serieID}/editarNome`;
            // função para fazer requisição dentro do js.
            fetch(url,{
                body: formData,
                method: 'POST'
            }).then(() => {
                toggleInput(serieID);
                document.getElementById(`nome-serie-${serieID}`).textContent = valor;
            });
        }
    </script>
@endsection

