<?php

namespace Tests\Unit;

use App\Episodio;
use App\Temporada;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemporadaTest extends TestCase
{
    /**
     * Temporada
     *
     * @var temporada
     */
    private $temporada;

    public function setUp(): void
    {
        parent::setUp();
        $dataTemporada =  new Temporada();
        for ($i=0; $i < 3 ; $i++) {
            $episodio = new Episodio();

            if ($i % 2 == 0) {
                $episodio->assistido = true;
            } else {
                $episodio->assistido = false;
            }

            $dataTemporada->episodios->add($episodio);
            unset($episodio);
        }

        $this->temporada = $dataTemporada;
    }

    public function testBuscaEpisodiosAssistidos()
    {
        $episodiosAssistidos = $this->temporada->getEpisodiosAssistidos();
        $this->assertCount(2, $episodiosAssistidos);
        foreach ($episodiosAssistidos as $episodio) {
            $this->assertTrue($episodio->assistido);
        }
    }

    public function testCountEpisodiosTemporada()
    {
        $episodiosTemporada = $this->temporada->episodios;
        $this->assertCount(3, $episodiosTemporada);
    }

    // public function testExisteEpisodiosTempordada()
    // {
        
    // }
}
