<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerificationToken extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['token', 'user_id'];

    /**
     * Belongs to users table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get route name
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'token';
    }
}
