<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'setting';
    protected $fillable = [
        'options',
        'mastertool',
        'headjs',
        'bodyjs',
        'tenvi', 'analytics',
    ];
    protected $casts = [
        'options' => 'array',
    ];
}
