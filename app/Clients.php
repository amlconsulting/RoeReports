<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model {

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];

    /**
     * Client details belong to invoice header
     *
     * @return mixed
     */
    public function invoices() {
        return $this->belongsTo('App\Invoices');
    }
}
