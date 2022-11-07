<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->integer('quantity');
            $table->float('price');
            $table->integer('returns')->default(0);
            $table->integer('recycling')->default(0);
            $table->boolean('removal_status', 50);

            $table->foreignId('color_id')->constrained();
            $table->foreignId('type_id')->constrained();
            $table->foreignId('size_id')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
