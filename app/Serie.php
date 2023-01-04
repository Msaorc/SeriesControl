<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    // protected $table = 'series'; para informar qual tabela esta referenciando
    public $timestamps = false; // para não utilizar os campos data de criação e modificação da tabela para controle do laravel
    protected $fillable = ['nome']; // para liberar o campo para ser inserido atravez do metodo create Serie::create([]);

    //metodo para atributo de relação, Essa serie tem muitas temporadas
    // Esse metodo diz que a Serie pode ter varias temporadas (1---n)
    public function temporadas(){
        return $this->hasMany(Temporada::class);
    }
}