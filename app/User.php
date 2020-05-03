<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::created(function (User $user) {
            $user->profile()->create([
                'title' => $user->username
            ]);
        });
    }

    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public function following() {
        return $this->belongsToMany(Profile::class);
    }

    public function posts() {
      return $this->hasMany(Post::class);
    }
}
