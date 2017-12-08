<?php

namespace App\Scholar\Subscribe;

use App\User;

trait Subscribable
{
    public function getSubscribedAttribute()
    {
        if (!auth()->check()) {
            return false;
        }

        if (! $this->relationLoaded('subscribed')) {
            $this->load([
                'subscribed' => function($query) {
                    $query->where('user_id', auth()->id());
                }
            ]);
        }

        $subscribed = $this->getRelation('subscribed');

        if (!empty($subscribed) && $subscribed->contain('id', auth()->id())) {
            return true;
        }

        return false;
    }

    public function getSubscribesCountAttribute()
    {
        if (array_key_exists('subscribed_count', $this->getAttributes())) {
            return $this->subscribed_count;
        }

        return $this->subscribed->count();
    }

    public function subscribed()
    {
        return $this->belongsToMany(User::class, 'subscribes', 'journal_id', 'user_id')->withTimestamps();
    }

    public function isSubscribedBy(User $user)
    {
        return !! $this->subscribed()->where('user_id', $user->id)->cound();
    }
}