<?php

namespace Tests\Unit;

use App\Serie;
use Tests\TestCase;
use App\Services\CriadorDeSerie;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CriadorSeriesTest extends TestCase
{
    use RefreshDatabase;

    public function testCriarSerie()
    {
        $criadorSerie = new CriadorDeSerie();
        $nome = 'Serie Teste automatizado';
        $serie = $criadorSerie->criarSerie($nome, 1, 1);
        $this->assertInstanceOf(Serie::class, $serie);
        $this->assertDatabaseHas('series', ['nome' => $nome]);
        $this->assertDatabaseHas('temporadas', ['serie_id' => $serie->id]);
        $this->assertDatabaseHas('episodios', ['numero' => 1]);
    }
}
