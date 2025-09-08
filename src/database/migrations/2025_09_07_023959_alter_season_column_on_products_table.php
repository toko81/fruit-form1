<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class AlterSeasonColumnOnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
         if (!Schema::hasColumn('products', 'season')) {
        $table->string('season')->nullable();}
        });

        if (Schema::hasColumn('products', 'season')) {
        DB::statement('ALTER TABLE products MODIFY season TEXT');
        }
    }    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE products MODIFY season VARCHAR(255)');

    }
}
