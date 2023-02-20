<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invite extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invites';
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'invite_uri', 'invited_email', 'expired', 'deleted', 'status'
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
     * Check expire time for invite
     *
     * @return boolean
     */
    public static function checkExpire($uri)
    {
        $check = self::where('invite_uri', '=', $uri)->get()->toArray();
        $created_date = strtotime($check[0]['created_at']);
        $current_date = strtotime(date("Y-m-d h:i:s"));
        $seconds_diff = $current_date - $created_date;
        $time = ($seconds_diff/3600);
        if (48 < $time) {
            return "expired";
        } else {
            return "active";
        }
    }
}
