<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'num_episode',
        'duration',
        'link',
        'is_premium'
    ];
    protected $with = ['anime'];

    public function anime(): BelongsTo {
        return $this->belongsTo(Anime::class);
    }
}
