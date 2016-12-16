<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterInvoiceColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('invoiceHeader', function(Blueprint $table) {
            $table->decimal('total', 5, 2)->change();
            $table->decimal('discount', 5, 2)->change();
            $table->decimal('tax', 5, 2)->change();
            $table->decimal('subTotal', 5, 2)->change();
            $table->decimal('totalPaid', 5, 2)->change();
        });

        Schema::table('invoiceDetail', function(Blueprint $table) {
            $table->decimal('price', 5, 2)->change();
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
