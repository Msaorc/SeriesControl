<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome'];
    
    public function objetivos()
    {
        return $this->hasMany(Objetivo::class);
    }

    public function suplemento()
    {
        return $this->belongsTo(Suplemento::class);
    }
}
