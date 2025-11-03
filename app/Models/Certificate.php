<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model {
    protected $fillable = [
        'title','issuer','issue_date',
        'file_path','is_published'
    ];
    protected $casts = [
        'is_published'=>'boolean',
        'issue_date'=>'date'
    ];
}
