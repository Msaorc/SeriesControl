<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\{Serie, Episodio, Temporada};
use App\Http\Requests\SeriesFormRequest;
use App\Services\{CriadorDeSerie, RemovedorDeSerie};

class SeriesController extends Controller 
{
    public function index(Request $request)
    {
        $listaSeries = Serie::query()->orderBy('nome')->get();
        $message = $request->session()->get('message');    
        $request->session()->remove('message');

        return view('series.index', compact('listaSeries','message'));
    }

    public function create(Request $request)
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {
        $serie = $criadorDeSerie->criarSerie($request->nome, $request->qtd_temporadas, $request->ep_por_temporada);
        $request->session()
            ->flash(
                'message',
                "Serie {$serie->id} e suas temporadas e epsodios criadas com sucesso {$serie->nome}"
        );

        return redirect()->route('listar_series');
    }

    public function destroy(Request $request, RemovedorDeSerie $removedorSerie)
    {
        $nomeSerie = $removedorSerie->removerSerie($request->id);
        $request->session()->flash(
            'message',
            "Serie $nomeSerie foi excluida com sucesso!"
        );

        return redirect()->route('listar_series');
    }

    public function edit(int $id, Request $request)
    {
        $serie = Serie::find($id);
        $serie->nome = $request->nome;
        $serie->save();
    }
}