<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulk extends Model
{
    use HasFactory;
    protected $fillable = [
        'number',
        'product_id',
        'enable',
        'min_quantity',
        'discount',
        'description'
    ];
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
