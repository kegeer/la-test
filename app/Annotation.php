<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annotation extends Model
{
    protected $fillable = ['title', 'body', 'selectors', 'paper_id'];

    protected $with = [
        'paper'
    ];

//    public function getTagsListAttribute()
//    {
//        return $this->tags()->pluck('name')->toArray();
//    }

//    public function getPaperAttribute()
//    {
//        return $this->paper()->pluck('filename');
//    }

//    public function getCommendsAttribute()
//    {
//        return $this->comments()->get()->toArray();
//    }

    public function getSelectorsAttribute()
    {
        return json_decode($this->attributes['selectors']);
    }



    public function getTagListAttribute()
    {
        return $this->tags->pluck('name')->toArray();
    }

    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->morphMany(Tag::class, 'tag_id');
    }
}
