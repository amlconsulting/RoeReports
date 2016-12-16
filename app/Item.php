<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

    /**
     * Set the table name
     *
     * @var String
     */
    protected $table = 'item';

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
    public function invoiceDetail() {
        return $this->belongsTo('App\InvoiceDetail');
    }

}
