<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    use HasFactory;
    protected $table = 'product_list';

    protected $fillable = [
        'name',
        'highlight',
        'visible',
    ];

    public function cats()
    {
        return $this->hasMany(ProductCat::class,'id_list');
    }
    public function items()
    {
        return $this->hasMany(ProductItem::class,'id_item');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'id_list');
    }
}
