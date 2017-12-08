<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $fillable = [
    	'post_id', 'mime', 'original_filename', 'filename'
    ];

//    protected $with = [
//        'annotations'
//    ];

    public function getAnnotationsAttribute()
    {
        return $this->annotations()->get()->toArray();
    }

//    public function post()
//    {
//    	return $this->belongsTo(Post::class);
//    }

    public function annotations()
    {
        return $this->hasMany(Annotation::class)->latest();
    }

//    public function getRouteKeyName ()
//    {
//        return 'filename';
//    }

}
