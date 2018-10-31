<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;

	protected $fillable = ['name', 'description', 'image', 'category_id', 'price'];
	protected $dates = ['deleted_at'];

    /**
     *  Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
