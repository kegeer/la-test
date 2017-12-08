<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function publications()
    {
        return $this->morphedByMany(Publication::class, 'taggable');
    }

    public function annotations()
    {
        return $this->morphedByMany(Annotation::class, 'taggable');
    }
}
