<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'content',
        'excerpt',
        'status',
        'type',
        'img',
        'img_thumb',
        'created_at',
        'updated_at',
    ];

    protected $table = 'posts';

}
