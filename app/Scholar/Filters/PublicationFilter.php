<?php

namespace App\Scholar\Filters;

use App\Tag;
use App\User;

class PublicationFilter extends Filter
{
//    protected function author($username)
//    {
//        $user = User::whereUsername($username)->first();
//
//        $userId = $user ? $user->id : null;
//
//        return $this->builder->whereUserId($userId);
//    }

    protected function favorited($username)
    {
        $user = User::whereUsername($username);

        $publicationIds = $user ? $user->favorites()->pluck('id')->toArray() : [];

        return $this->builder->whereIn('id', $publicationIds);
    }

    protected function tag($name)
    {
        $tag = Tag::whereName($name);

        $publicationIds = $tag ? $tag->publication()->pluck('publication_id')->toArray(): [];
        return $this->builder->whereIn('id', $publicationIds);
    }
}