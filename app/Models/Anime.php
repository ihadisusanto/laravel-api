<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Anime extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_japan',
        'title_english',
        'slug',
        'episodes',
        'studios',
        'release_year',
        'genre',
        'image_url',
        'description',
        'status',
        'rating',
    ];

        // Set the primary key type to string (for UUID)
        protected $keyType = 'string';
    
        // Disable auto-incrementing because UUIDs are not auto-incremented
        public $incrementing = false;

        // Automatically generate UUID when creating a new model
        protected static function boot()
        {
            parent::boot();

            static::creating(function ($model) {
                if (empty($model->id)) {
                    $model->id = (string) Str::uuid();
                }
            });
        }
}
