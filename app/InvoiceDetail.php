<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model {

    /**
     * Set the table name
     *
     * @var String
     */
    protected $table = 'invoiceDetail';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'invoiceHeader_id', 'item_id', 'size_id', 'created_at', 'updated_at'
    ];

    /**
     * Invoice details belong to invoice header
     *
     * @return mixed
     */
    public function invoices() {
        return $this->belongsTo('App\Invoices');
    }

    /**
     * Get the item details for the detail record
     *
     * @return JSON
     */
    public function item() {
        return $this->hasOne('App\Item', 'id', 'item_id');
    }

    /**
     * Get the size details for the detail record
     *
     * @return JSON
     */
    public function size() {
        return $this->hasOne('App\Size', 'id', 'size_id');
    }

}
