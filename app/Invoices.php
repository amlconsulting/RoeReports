<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model {

    /**
     * Set the table name
     *
     * @var String
     */
    protected $table = 'invoiceHeader';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'user_id', 'client_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be mutated to dates
     *
     * @var array
     */
    protected $dates = [
        'invoiceDate', 'subscription_ends_at'
    ];

    /**
     * Get the client details for the invoice
     *
     * @return JSON
     */
    public function client() {
        return $this->hasOne('App\Clients', 'id', 'client_id');
    }

    /**
     * Get the detail records for the invoice
     *
     * @return JSON
     */
    public function invoiceDetail() {
        return $this->hasMany('App\InvoiceDetail', 'invoiceHeader_id');
    }

}
