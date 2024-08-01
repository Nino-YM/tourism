<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_article';

    protected $fillable = [
        'article_name',
        'article_content',
        'published_date',
        'id_user'
    ];
}
