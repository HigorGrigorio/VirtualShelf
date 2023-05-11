<?php

namespace App\Models;

use Database\Factories\PublisherFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'state_id'
    ];

    protected function newFactory(): PublisherFactory
    {
        return new PublisherFactory();
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
