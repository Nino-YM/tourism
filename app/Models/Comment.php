<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_comment';

    protected $fillable = [
        'comment_content',
        'comment_date',
        'id_article',
        'id_user'
    ];
}
