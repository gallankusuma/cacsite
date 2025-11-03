<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model {
    protected $fillable = [
        'category_id','name','slug','summary','description',
        'specs','datasheet_path','hero_image','is_published',
        'meta_title','meta_description','og_image',
    ];
    protected $casts = [
        'specs'=>'array',
        'is_published'=>'boolean'
    ];
    public function category(): BelongsTo {
        return $this->belongsTo(ProductCategory::class,'category_id');
    }
}
