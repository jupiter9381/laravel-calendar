<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PayrollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id');
            $table->string('month');
            $table->string('working_hours');
            $table->string('saturday_hours');
            $table->string('sunday_hours');
            $table->string('night_hours');
            $table->string('feast_hours');
            $table->string('total_amount');
            $table->string('status');
            $table->text('note');
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
