<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'gallery';
    protected $fillable = [
        'id_product','image','sort_order',
    ];
    public function products(){
        return $this->belongsTo(Product::class,'id_product','id');
    }
}
