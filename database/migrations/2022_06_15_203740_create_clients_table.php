<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
           
            $table->id();
            $table->string('company_name', 50);
            $table->string('first_name_contact', 50);
            $table->string('last_name_contact', 50);
            $table->string('phone_contact', 20);
            $table->string('branch', 50);
            $table->text('address');
            $table->boolean('removal_status', 50);

            $table->foreignId('state_id')->constrained();
            $table->foreignId('city_id')->constrained();
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
