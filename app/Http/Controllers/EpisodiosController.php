<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Temporada $temporada, Request $request)
    {
        
        // fazer antes de iniciar a proxima aula, carregar uma pagina com os episodios da serie selecionada
        // No parametro colocar uma Temporada passando o objeto
        // pegando os epsodios utilizando a Temporada->episodios();
        // se não conseguir rever a aula anterior.
        $episodios = $temporada->episodios;
        $temporadaId = $temporada->id;
        $mensagem = $request->session()->get('mensagem');
        return view('episodios.index', compact('episodios','temporadaId','mensagem'));
    }

    public function assistir(Temporada $temporada, Request $request)
    {
        $episodiosAssistidos = $request->episodios;
        $ids = [];
        $temporada->episodios->each(function (Episodio $episodio)
        use ($episodiosAssistidos, $ids)
        {
            $episodio->assistido = in_array(
                $episodio->id,
                $episodiosAssistidos
            );
            // $ids = $episodio->id;
        });    
        $temporada->push();
        $request->session()->flash('mensagem', 'Episódios marcados como assitidos');
        return redirect()->back();
    }    
}
