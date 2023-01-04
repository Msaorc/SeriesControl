<?php

namespace App\Services;
use App\{Serie, Temporada};
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(String $nomeSerie, int $qtdeTemporadas, int $epPorTemporada) : Serie
    {
        DB::beginTransaction();
        $serie = Serie::create(['nome' => $nomeSerie]);
        $this->criarTemporadas($serie, $qtdeTemporadas, $epPorTemporada);
        DB::commit();

        return $serie;
    }

    private function criarTemporadas(Serie $serie, int $qtdeTemporadas, int $epPorTemporada)
    {
        for ($i = 1; $i <= $qtdeTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criarEpisodios($temporada, $epPorTemporada);
        }
    }

    private function criarEpisodios(Temporada $temporada, int $epPorTemporada)
    {
        for($j = 1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}