<?php

namespace App;

use App\Scholar\Favorite\Favoritable;
use App\Scholar\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use Favoritable, Filterable;

    protected $fillable = [
        'title', 'abstract', 'published_at'
    ];

    protected $with = [
        'tags', 'authors', 'annotations'
    ];

    public function getTagsListAttribute ()
    {
        return $this->tags->pluck('name')->toArray();
    }

    public function getAuthorsListAttribute()
    {
        return $this->authors->toArray();
    }

    public function getAnnotationCountAttribute()
    {
        return $this->annotations->count();
    }

    public function scopeLoadRelations($query)
    {
        return $query->with(['favorited' => function($query) {
                $query->where('user_id', auth()->id());
            }])
            ->withCount('favorited');
    }

    public function journal()
    {
        return $this->belongsTo(Journal::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_publication', 'publication_id', 'author_id');
    }

    public function annotations()
    {
        return $this->hasMany(Annotation::class)->latest();
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
