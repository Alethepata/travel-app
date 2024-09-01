<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'image_name'

    ];

    public function Stages(){

        return $this->belongsToMany(Stage::class);
    }

}
