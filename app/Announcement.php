<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'body',
        'owner_id'
    ];

    /**
     * Get user record associated with the announcement.
     *
     * @return mixed
     */
    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get all recipients associated with the announcement.
     *
     * @return mixed
     */
    public function recipients()
    {
        return $this->belongsToMany('App\User', 'announcement_recipients');
    }

    /**
     * Get all images associated with the announcement.
     *
     * @return mixed
     */
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
}
