<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Lorisleiva\LaravelSearchString\Concerns\SearchString;

class Post extends Model
{
    use HasFactory, SearchString;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'body',
    ];

    /**
     * The attributes that are searchable.
     */
    protected $searchStringColumns = [
        'title' => ['searchable' => true],
    ];

    /**
     * Relationships.
     */
    public function user()
    {
        return $this->belongsTo( 'App\Models\User' );
    }
}
