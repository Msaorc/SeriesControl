<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RemovedorDeSerieTest extends TestCase
{
    private $serie;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $criadorSerie = new CriadorDeSerie();
        $this->serie = $criadorSerie->criarSerie('Nome da serie', 1, 1);
    } 
    public function testRemoverSerie()
    {
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);
        $removedorSeries = new RemovedorDeSerie();
        $nomeSerie = $removedorSeries->removerSerie($this->serie->id);
        $this->assertIsString($nomeSerie);
        $this->assertEquals('Nome da serie', $this->serie->nome);
        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);
    }
}
