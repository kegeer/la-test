<?php

namespace App\Scholar\Subscribe;

use App\Journal;

trait HasSubscribe
{
    public function subscribe(Journal $journal)
    {
        if (!$this->hasSubscribed($journal)) {
            return $this->subscribes()->attach($journal);
        }
    }

    public function unSubscribe(Journal $journal)
    {
        return $this->subscribes()->detach($journal);
    }

    public function subscribes()
    {
        return $this->belongsToMany(Journal::class, 'subscribes', 'user_id', 'subscribe_id')->withTimestamps();
    }

    public function hasSubscribed(Journal $journal)
    {
        return !! $this->subscribes()->where('journal_id', $journal->id)->count();
    }
}