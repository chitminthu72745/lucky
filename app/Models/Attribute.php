<?php

namespace App\Models;

use App\Models\Term;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    /**
     * Get the Terms record associated with the attribute.
     */
    public function terms()
    {
        return $this->hasOne(Term::class);
    }
}
