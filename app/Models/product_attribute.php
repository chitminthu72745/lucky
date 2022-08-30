<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'term_id',
    ];
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
