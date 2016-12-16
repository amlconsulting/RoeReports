<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('invoiceHeader', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('client_id')->references('id')->on('clients');
            $table->integer('invoiceNum');
            $table->binary('shipped');
            $table->timestamp('invoiceDate');
            $table->double('total');
            $table->double('discount');
            $table->double('tax');
            $table->double('subTotal');
            $table->double('totalPaid');
            $table->timestamps();
        });

        Schema::create('invoiceDetail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoiceHeader_id');
            $table->foreign('invoiceHeader_id')->references('id')->on('invoiceHeader')->onDelete('cascade');
            $table->integer('item_id')->references('id')->on('item');
            $table->integer('size_id')->references('id')->on('size');
            $table->integer('quantity');
            $table->double('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('invoiceDetail');
        Schema::drop('invoiceHeader');
    }
}
