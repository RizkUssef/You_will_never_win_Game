<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $fillable =[
        "id",
        "question",
        "answer",
        "error_text",
        "error_image",
        'created_at',
        'updated_at'
    ];
}
