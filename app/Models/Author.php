<?php

namespace App\Models;

use Database\Factories\AuthorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname'
    ];

    protected $table = 'Author';

    public static function factory(): AuthorFactory
    {
        return new AuthorFactory();
    }
}
