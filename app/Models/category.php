<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = ['catname','image'];
    
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
