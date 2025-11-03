<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model {
    protected $fillable = [
        'country','city','address','phone','email',
        'type','is_published'
    ];
    protected $casts = [
        'is_published'=>'boolean'
    ];
}
