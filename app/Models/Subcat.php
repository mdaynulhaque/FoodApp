<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cat;

class Subcat extends Model
{
    public function category()
    {
    	return $this->belongsTo(Cat::class,'cat_id');
    }
}
