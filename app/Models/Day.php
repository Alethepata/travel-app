<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    public function stage(){

        return $this->hasMany(Stage::class);
    }

    public static function getDay($s, $e){

        $start=date_create($s);
        $ending=date_create($e);

        $result = date_diff($start,$ending);

        return $result->days;
    }

    public static function getDate($s, $day){

        $date=date_create($s);
        $result = date_add($date, date_interval_create_from_date_string($day . 'days'));

        return $result;
    }

}
