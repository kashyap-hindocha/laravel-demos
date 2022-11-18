<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('products', 'user_id')) {
            Schema::table('products', function($table) {
                $table->integer('user_id');
                //need to use after.
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('products', 'user_id')) {
            Schema::table('products', function($table) {
                $table->dropColumn('user_id');
            });
        }
    }
};
