<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LuLaRoeCookies extends Model {

    /**
     * Set the table name
     *
     * @var String
     */
    protected $table = 'lularoe_cookies';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'user_id', 'created_at', 'updated_at'
    ];

}
