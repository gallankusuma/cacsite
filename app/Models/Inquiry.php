<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model {
    protected $fillable = [
        'type','name','email','phone','subject',
        'message','meta','status'
    ];
    protected $casts = [
        'meta'=>'array',
    ];
}
