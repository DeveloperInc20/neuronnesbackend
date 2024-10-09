<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // Ajouté pour permettre l'assignation de masse
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image_path',
        'created_at',
        'last_update',
    ];
}
