<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagePathToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'image_path')) {
            $table->string('image_path')->nullable();
            }
        });

        if (Schema::hasColumn('products', 'image_path')) {
        DB::statement('ALTER TABLE products MODIFY image_path TEXT');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            DB::statement('ALTER TABLE products MODIFY image_path VARCHAR(255)');
        });
    }
}
