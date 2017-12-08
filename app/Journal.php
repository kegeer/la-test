<?php

namespace App;

use App\Scholar\Subscribe\Subscribable;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use Subscribable;

    protected $fillable = [
        'title', 'issn'
    ];

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }
}
