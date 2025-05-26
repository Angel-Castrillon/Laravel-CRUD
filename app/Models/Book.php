<?php

namespace App\Models;

use App\Models\Rental;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'stock'
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
