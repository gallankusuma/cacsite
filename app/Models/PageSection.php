<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSection extends Model {
    protected $fillable = [
        'page_id','key','title','body',
        'media_path','sort_order','is_published'
    ];
    protected $casts = ['is_published'=>'boolean'];
    public function page(): BelongsTo { return $this->belongsTo(Page::class); }
}
