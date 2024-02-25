<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    use HasFactory;
    protected $table = 'photos';
    protected $fillable = ['stt','image', 'title', 'description', 'link','type','highlight',
    'visible'];
}
