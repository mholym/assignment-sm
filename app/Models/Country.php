<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name', 'full_name', 'iso3', 'continent_code', 'display_order', 'number'];
    public $timestamps = false;

    public function carts()
    {
        return $this->belongsToMany(Cart::class)->withTimestamps()->withPivot('quantity');
    }
}
