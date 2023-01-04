<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\{Serie, Episodio, Temporada};

class RemovedorDeSerie
{
    public function removerSerie(int $serieId) : string
    {
        $nomeSerie = '';
        DB::beginTransaction();
        $serie = Serie::find($serieId);
        $nomeSerie = $serie->nome;
        $this->removerTemporadas($serie);
        $serie->delete();
        DB::commit();

        return $nomeSerie;
    }
    
    private function removerTemporadas(Serie $serie)
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });
    }

    private function removerEpisodios(Temporada $temporada)
    {
        $temporada->episodios->each(function (Episodio $episodio){
            $episodio->delete();
        });
    }
}