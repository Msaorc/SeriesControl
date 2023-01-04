<?php
namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\{Tipo,Objetivo,Suplemento};

class RemovedorDeSuplemento
{
    public function removerSuplemento(int $idSuplemento) : String
    {
        DB::beginTransaction();
        $suplemento = Suplemento::find($idSuplemento);
        $this->removerTipos($suplemento);
        $nomeSuplemento = $suplemento->nome;
        $suplemento->delete();
        DB::commit();

        return $nomeSuplemento;
    }

    private function removerTipos(Suplemento $suplemento)
    {
        $suplemento->tipos->each(function (Tipo $tipo) {
            $this->removerObjetivos($tipo);
            $tipo->delete();
        });
    }

    private function removerObjetivos(Tipo $tipo)
    {
        $tipo->objetivos->each(function (Objetivo $objetivo){
            $objetivo->delete();
        });
    }
}