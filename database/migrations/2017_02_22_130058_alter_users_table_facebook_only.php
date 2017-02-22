<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableFacebookOnly extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name',
                'password',
                'verified',
                'activation_token',
                'remember_token'
            ]);

            $table->string('name', 255);
            $table->string('facebook_id', 255);
            $table->string('facebook_access_token', 2000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn([
                'name',
                'facebook_id',
                'facebook_access_token'
            ]);

            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('password', 255);
            $table->tinyInteger('verified');
            $table->string('activation_token', 255);
            $table->string('remember_token', 100);
        });
    }
}
