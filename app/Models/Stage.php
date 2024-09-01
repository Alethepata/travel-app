<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'place',
        'curiosities',
        'images',
        'is_visited',
        'latitude',
        'longitude',
        'rating',
        'notes',
        'day_id'

    ];

    public function Days(){

        return $this->belongsTo(Day::class);
    }

    public function Images(){

        return $this->belongsToMany(Image::class);
    }

    public function Curiosities(){

        return $this->belongsToMany(Curiosity::class);
    }

    public function Notes(){

        return $this->belongsToMany(Note::class);
    }

    public static function generateSlug($string){

        $slug =  Str::slug($string, '-');
        $original_slug = $slug;

        $exists = Stage::where('slug', $slug)->first();
        $c = 1;

        while ($exists) {
            $slug = $original_slug . '-' . $c;
            $exists = Stage::where('slug', $slug)->first();
            $c++;
        }
        return $slug;
    }


    public static function getLatLong($address){

        $apiKey = $_ENV['API_KEY_TOMTOM'];
        $apiUrl = 'https://api.tomtom.com/search/2/geocode/';

        if(!empty($address)){

            $formattedAddr = str_replace(' ','+',$address);

            $geocodeFromAddr = file_get_contents($apiUrl. $formattedAddr.'.json?key='.$apiKey);
            $output = json_decode($geocodeFromAddr);

            $data['latitude']  = $output->results[0]->position->lat;
            $data['longitude'] = $output->results[0]->position->lon;

            $data['place'] = $output->results[0]->address->freeformAddress;

            if(!empty($data)){
                return $data;
            }else{
                return false;
            }

        }else{
            return false;
        }
    }

}
