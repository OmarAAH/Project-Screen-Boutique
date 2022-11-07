<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->dateTime('created_at');
            $table->integer('sold');
            $table->float('total');

            $table->foreignId('client_id')->constrained();
            $table->foreignId('design_id')->constrained();
            $table->foreignId('employee_id')->constrained();
            $table->foreignId('product_id')->constrained();
            
            $table->date('date_delivery')->nullable();
            $table->foreignId('delivery_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
