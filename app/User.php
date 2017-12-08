<?php

namespace App;

use App\Scholar\Favorite\HasFavorite;
use App\Scholar\Follow\Followable;
use App\Scholar\Subscribe\HasSubscribe;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Facades\JWTAuth;

class User extends Authenticatable
{
    use Notifiable, Followable, HasFavorite, HasSubscribe;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'bio', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = (
            password_get_info($value)['algo'] === 0
        ) ? bcrypt($value):$value;
    }

    public function getTokenAttribute()
    {
        return JWTAuth::fromUser($this);
    }

    public function annotations()
    {
        return $this->hasMany(Annotation::class)->latest();
    }

    public function feed()
    {
        $followingIds = $this->following()->pluck('id')->toArray();

        return Annotation::loadRelations()->whereIn('user_id', $followingIds);
    }

    public function getRouteKey()
    {
        return 'username';
    }

     public function posts()
     {
         return $this->hasMany(Post::class)->latest();
     }
}
