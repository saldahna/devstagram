<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
     * Se crea la relación con el modelo Post,
     * y trae todos los post relacionados al usuario (One To Many)
     */
    public function posts() {

        return $this->hasMany(Post::class);

    }

    /*
     * Se crea la relación de likes con el usuario,
     * porque un usuario puede dar muchos likes
     */
    public function likes() {
        
        return $this->hasMany(Like::class);

    }

    /*
     * Almacena los seguidos de un usuario, la relación es: un usuario puede tener muchos seguidores
     * 'followers' no sigue las convenciones de Laravel
     */
    public function followers() {
        
        /*
         * Se referencía a la tabla 'followers'
         */
        return $this->BelongsToMany(User::class, 'followers', 'user_id', 'follower_id');

    }

    public function following() {
        
        return $this->BelongsToMany(User::class, 'followers', 'follower_id', 'user_id');

    }

    /*
     * Comprobar si un usuario ya sigue a otro
     */
    public function isFollowing(User $user) {
        
        return $this->followers->contains($user->id);

    }



}
