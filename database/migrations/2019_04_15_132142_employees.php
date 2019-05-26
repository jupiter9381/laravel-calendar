<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Employees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->string('zip');
            $table->string('city');
            $table->string('email');
            $table->string('mobile');
            $table->string('birthday');
            $table->string('type');
            $table->string('rate_per_hour');
            $table->string('base_salary');
            $table->string('extra_charge_night');
            $table->string('extra_charge_sunday');
            $table->string('extra_charge_feast');
            $table->string('custom_field1');
            $table->string('custom_field2');
            $table->string('custom_field3');
            $table->string('custom_field4');
            $table->string('custom_field5');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
