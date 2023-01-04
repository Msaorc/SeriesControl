<?php

namespace App\Services;
use App\{Tipo, Suplemento};
use Illuminate\Support\Facades\DB;

class CriadorDeSuplemento
{
    public function criarSuplemento(String $nomeSuplemento, String $tipoSuplemento, String $objetivoSuplemento) : Suplemento
    {
        DB::beginTransaction();
        $suplemento = Suplemento::create(['nome' => $nomeSuplemento]);
        $this->criarTipo($suplemento, $tipoSuplemento, $objetivoSuplemento);
        DB::commit();

        return $suplemento;
    }

    public function criarTipo(Suplemento $suplemento, String $nomeTipo, String $objetivo)
    {
        $tipo = $suplemento->tipos()->create(['nome' => $nomeTipo]);
    }

    public function criarObjetivo(Tipo $tipo, String $nomeObjetivo)
    {
        $tipo->objetivos()->create(['nome' => $nomeObjetivo]);
    }
}