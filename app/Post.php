<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'url', 'title', 'post_content'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Get the user who created the post.
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the users who have liked the post.
     */
    public function likes() {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
