<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    public $timestamps = false;
    public $fillable = ['numero'];

    public function temporada(){
        return $this->hasMany(Temporada::class);
    }
}
