<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Lorisleiva\LaravelSearchString\Concerns\SearchString;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SearchString;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that are searchable.
     */
    protected $searchStringColumns = [
        'name' => ['searchable' => true],
        'email' => ['searchable' => true],
        'posts' => ['key' => '/^posts?$/', 'relationship' => true],
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationships.
     */
    public function posts()
    {
        return $this->hasMany( 'App\Models\Post' );
    }
}
