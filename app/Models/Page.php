<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model {
    protected $fillable = [
        'slug','title','subtitle','type','body',
        'hero_image','hero_video_url','hero_video_poster',
        'is_published','published_at',
        'meta_title','meta_description','og_image',
    ];
    protected $casts = [
        'is_published'=>'boolean',
        'published_at'=>'datetime',
    ];
    public function sections(): HasMany {
        return $this->hasMany(PageSection::class)->orderBy('sort_order');
    }
}
