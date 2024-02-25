<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCat extends Model
{
    use HasFactory;
    protected $table = 'product_cat';

    protected $fillable = [
        'name',
        'id_list',
        'highlight',
        'visible',
    ];
    public function productItems()
    {
        return $this->hasMany(ProductItem::class,'id_cat','id');
    }
    public function productList()
    {
        return $this->belongsTo(ProductList::class,'id_list');
    }

    public function product()
    {
        return $this->hasMany(Product::class,'id_cat','id');
    }
}
