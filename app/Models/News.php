<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = ['id'];
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory;
}
