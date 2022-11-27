<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Backpack\CRUD\app\Models\Traits\CrudTrait; // <------------------------------- this one
use Spatie\Permission\Traits\HasRoles;// <---------------------- and this one
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class User extends Authenticatable
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use CrudTrait; // <----- this

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $guard_name = 'web';
    
    protected $fillable = [
        'name',
        'email',
        'password',
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
    public function places()
    {
        return $this->hasMany(Place::class, 'author_id');
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    } 
    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes');
    }
    public function favorites()
    {
        return $this->belongsToMany(Place::class, 'favorites');
    }

    


}
