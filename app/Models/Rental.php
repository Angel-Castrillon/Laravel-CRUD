<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rental extends Model
{
    public function book()
{
    return $this->belongsTo(Book::class);
}

    protected $fillable = [
        'user_id',
        'book_id',
        'rental_date',
        'return_date',
    ];
}
