@extends('layout')

@section('titulo')
    Suplementos
@endsection

@section('cabecalho')
    Suplementos
@endsection

@section('conteudo')
    @include('mensagem', ['mensagem' => $mensagem])

    <a href="{{route('form_adicionar_suplementos')}}" class="btn btn-dark mb-2">Adicionar</a>

    <ul class="list-group">
        @foreach ($listaSuplementos as $suplemento)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="nome-suplemento-{{ $suplemento->id }}">{{ $suplemento->nome }}</span>    
                <div class="input-group w-50" hidden id="input-nome-suplemento-{{ $suplemento->id }}">
                    <input type="text" class="form-control" value="{{ $suplemento->nome }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarSerie({{ $suplemento->id }})">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>
                <span class="d-flex">
                    <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $suplemento->id }})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <a href="/suplementos/{{$suplemento->id}}/tipos" class="btn btn-info btn-sm mr-1">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    <form action="/suplementos/{{$suplemento->id}}" method="post" 
                        onsubmit="return confirm('Tem certeza que deseja excluir {{ addslashes($suplemento->nome)}}?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </span>
            </li>
        @endforeach
    </ul>

    <script>
        function toggleInput(serieId) {
            console.log(serieId);
            const nomeSerieEl = document.getElementById(`nome-suplemento-${serieId}`);
            const inputSerieEl = document.getElementById(`input-nome-suplemento-${serieId}`);
            if (nomeSerieEl.hasAttribute('hidden')) {
                nomeSerieEl.removeAttribute('hidden');
                inputSerieEl.hidden = true;
            } else {
                inputSerieEl.removeAttribute('hidden');
                nomeSerieEl.hidden = true;
            }
        }

        function editarSerie(suplementoID){
            let formData = new FormData();
            const valor = document.querySelector(`#input-nome-suplemento-${suplementoID} > input`).value;
            const token = document.querySelector('input[name="_token"]').value;
            formData.append('nome', valor);
            formData.append('_token', token);      
            console.log(valor, token);
            const url = `/suplementos/${suplementoID}/editarSuplemento`;
            // função para fazer requisição dentro do js.
            fetch(url,{
                body: formData,
                method: 'POST'
            }).then(() => {
                toggleInput(suplementoID);
                document.getElementById(`nome-suplemento-${suplementoID}`).textContent = valor;
            });
        }
    </script>
@endsection