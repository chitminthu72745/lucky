<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
    public function product_category()
    {
        return $this->hasMany(product_category::class);
    }
    public function product_attribute()
    {
        return $this->hasMany(product_attribute::class);
    }
    public function preparation()
    {
        return $this->hasMany(Preparation::class);
    }
    public function bulk()
    {
        return $this->hasMany(Bulk::class);
    }
    public function tag()
    {
        return $this->hasMany(Tag::class);
    }
}
