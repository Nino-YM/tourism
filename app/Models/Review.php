<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_review';

    protected $fillable = [
        'rating',
        'review_content',
        'review_date',
        'id_event',
        'id_user'
    ];
}
