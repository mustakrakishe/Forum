<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $fillable = [
        'text',
        'author_id',
        'topic_id',
        'answer_to_id',
    ];

    protected $with = [
        'author',
        'answer_tree',
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

    public function answer_tree(){
        return $this->hasMany(Comment::class, 'answer_to_id')->with('answer_tree');
    }
}
