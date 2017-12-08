<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email'
    ];

    public function publications()
    {
        return $this->belongsToMany(Publication::class, 'author_publication', 'author_id', 'publication_id');
    }

}
