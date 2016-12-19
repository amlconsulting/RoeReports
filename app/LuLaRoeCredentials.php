<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LuLaRoeCredentials extends Model {

    /**
     * Set the table name
     *
     * @var String
     */
    protected $table = 'lularoe_credentials';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'user_id', 'password', 'created_at', 'updated_at'
    ];

}