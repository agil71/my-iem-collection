<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{    
        protected $fillable = [
        'user_id', // Pastikan user_id bisa diisi
        'image',
        'title',
        'description',
        'price',
        'stock',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}