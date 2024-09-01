<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curiosity extends Model
{
    use HasFactory;

    protected $fillable = [
        'curiosity'

    ];

    public function Stages(){

        return $this->belongsToMany(Stage::class);
    }

}
