<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    use HasFactory;
    protected $table = 'product_item';

    protected $fillable = [
        'name',
        'id_list',
        'id_cat',
        'highlight',
        'visible',
    ];

    public function productList()
    {
        return $this->belongsTo(ProductList::class,'id_list','id');
    }
    public function productCat()
    {
        return $this->belongsTo(ProductCat::class,'id_cat','id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'id_item','id');
    }
}
