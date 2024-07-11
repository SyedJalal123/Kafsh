<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Product extends Model implements Viewable
{
    use HasFactory, SoftDeletes;
    use InteractsWithViews;
    
    protected $casts = [
        'images' => 'array',
        'collections' => 'array',
        'tags' => 'array'
    ];

    public function variations(){
        return $this->hasMany(Variation::class, 'product_id','id');
    }
}
