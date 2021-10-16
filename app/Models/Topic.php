<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    public $fillable = [
        'header',
        'description',
        'author_id',
    ];
    
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('ancient', function (Builder $builder) {
            $builder->latest();
        });
    }

    public function author(){
        return $this->belongsTo(User::class)->withDefault();
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function root_comments(){
        return $this->hasMany(Comment::class)->where('answer_to_id', null);
    }
}
