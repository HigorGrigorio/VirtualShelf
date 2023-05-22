<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PublisherLanguage extends Model
{
    use HasFactory;

    protected $table = 'publishers_languages';

    protected $fillable = [
        'publisher_id',
        'language_id'
    ];

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
