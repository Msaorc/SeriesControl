<?php

namespace App\Http\Controllers;
use App\Suplemento;
use Illuminate\Http\Request;
use App\Services\CriadorDeSuplemento;
use App\Services\RemovedorDeSuplemento;
use App\Http\Requests\SuplementosFormRequest;

class SuplementosController extends Controller 
{
    public function index(Request $request)
    {
        // $listaSuplementos = Suplemento::all();
        $listaSuplementos = Suplemento::query()
                                    ->orderBy('nome')
                                    ->get();
        $message = $request->session()->get('message');
        $request->session()->remove('message');

        return view('suplementos.index', compact('listaSuplementos', 'message'));
    }

    public function create(){
        return view('suplementos.create');
    }

    public function store(SuplementosFormRequest $request, CriadorDeSuplemento $criadorSuplemento)
    {
        $suplemento = $criadorSuplemento->criarSuplemento($request->nome, $request->tipo_nome, $request->objetivo_nome);

        $request->session()->flash(
            'message',
            "Suplemento {$suplemento->id}-{$suplemento->nome} inserido com sucesso"
        );

        return redirect()->route('listar_suplementos');
    }

    public function destroy(Request $request, RemovedorDeSuplemento $removedorSuplemento)
    {
        $nomeSuplemento = $removedorSuplemento->removerSuplemento($request->id);
        $request->session()->flash(
            'message',
            "Serie $nomeSuplemento foi excluida com sucesso!"
        );
        return redirect()->route('listar_suplementos');
    }

    public function edit(int $id, Request $request)
    {
        $suplemento = Suplemento::find($id);
        $suplemento->nome = $request->nome;
        $suplemento->save();
    }
}