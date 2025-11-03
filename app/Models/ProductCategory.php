<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model {
    protected $fillable = [
        'slug','name','short_desc','icon_path',
        'sort_order','is_published'
    ];
    protected $casts = ['is_published'=>'boolean'];
    public function products(): HasMany {
        return $this->hasMany(Product::class,'category_id');
    }
}
