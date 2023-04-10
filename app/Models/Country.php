<?php

namespace App\Models;

use Database\Factories\CountryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    protected function getIconAttribute()
    {
        return asset('images/countries/flags/256x192/' . strtolower($this->code) . '.png');
    }

    public static function factory(): CountryFactory
    {
        return new CountryFactory();
    }
}
