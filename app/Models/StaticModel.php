<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticModel extends Model
{
    use HasFactory;
    protected $table = 'static';
    protected $fillable = ['title', 'slug', 'mota', 'content', 'visible', 'highlight','type'];

}
