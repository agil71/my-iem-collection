<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'image',
        'title',
        'description',
        'price',
        'stock',
        'sound_signature',
        'frequency_data',
    ];

    protected $casts = [
        'frequency_data' => 'string',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getFrequencyDataAttribute($value) {
        if (empty($value)) return null;
        $decoded = json_decode($value, true);
        return json_last_error() === JSON_ERROR_NONE ? $decoded : null;
    }
}