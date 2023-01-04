<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Suplemento extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome'];

    public function tipos(){
        return $this->hasMany(Tipo::class);
    }
}