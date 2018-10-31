<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Get the product records associated with the category.
     */
    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
