<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterInvoiceDecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('invoiceHeader', function(Blueprint $table) {
            $table->decimal('total', 7, 2)->change();
            $table->decimal('discount', 7, 2)->change();
            $table->decimal('tax', 7, 2)->change();
            $table->decimal('subTotal', 7, 2)->change();
            $table->decimal('totalPaid', 7, 2)->change();
        });

        Schema::table('invoiceDetail', function(Blueprint $table) {
            $table->decimal('price', 7, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

    }
}
