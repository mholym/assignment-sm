<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name', 'full_name', 'iso3', 'continent_code', 'display_order', 'number'];

    public function countries()
    {
        return $this->hasMany(Country::class, 'continent_code', 'code');
    }
}
