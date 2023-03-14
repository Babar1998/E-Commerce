<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'cate_id',
        'name',
        'slug',
        'medium_description',
        'description',
        'original_price',
        'selling_price',
        'image',
        'qty',
        'tax',
        'status',
        'trending',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'cate_id','id');
    }
}
