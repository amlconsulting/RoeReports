<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetDefaultDiscountValueInvoice extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()     {
        Schema::table('invoiceHeader', function(Blueprint $table) {
            $table->decimal('discount', 5, 2)->default(0.00)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()     {
        //
    }
}
