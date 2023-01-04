<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome'];

    public function tipo(){
        return $this->belongsTo(Tipo::class);
    }
}
