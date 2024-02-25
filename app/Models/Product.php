<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'id_list', 'id_cat', 'id_item', 'id_brand', 'name',
        'tenkhongdauvi', 'views', 'image', 'content', 'highlight', 'description', 'price', 'visible',
    ];
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'id_product', 'id');
    }

    public function productCat()
    {
        return $this->belongsTo(ProductCat::class, 'id_cat', 'id');
    }

    public function productItem()
    {
        return $this->belongsTo(ProductItem::class, 'id_item', 'id');
    }

    public function productList()
    {
        return $this->belongsTo(ProductList::class, 'id_list', 'id');
    }
    public function productBrand()
    {
        return $this->belongsTo(ProductBrand::class, 'id_brand', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (empty($model->tenkhongdauvi) && !empty($model->name)) {
                $model->tenkhongdauvi = Str::slug($model->name);
            }
        });
    }
}
