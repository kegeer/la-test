<?php

namespace App\Scholar\Favorite;

use App\Publication;

trait HasFavorite
{
    public function favorite(Publication $publication)
    {
        if (!$this->hasFavorited($publication)) {
            return $this->favorites()->attach($publication);
        }
    }

    public function unFavorite(Publication $publication)
    {
        return $this->favorites()->detach($publication);
    }

    public function favorites()
    {
        return $this->belongsToMany(Publication::class, 'favorites', 'user_id', 'publication_id')->withTimestamps();
    }

    public function hasFavorited(Publication $publication)
    {
        return !! $this->favorites()->where('publication_id', $publication->id)->count();
    }
}