<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'description'
    ];


    public function papers()
    {
        return $this->hasMany(Paper::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
