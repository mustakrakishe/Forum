<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'content',
        'user_id',
    ];

    public function author(){
        return $this->belongsTo(User::class);
    }
}
