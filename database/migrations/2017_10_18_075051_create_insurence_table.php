<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsurenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 100);
            $table->unique('number');
            $table->date('from');
            $table->date('to');
            $table->string('pay_form', 100)->nullable();
            $table->double('amount', 15, 8)->nullable();
            $table->double('gainings', 15, 8)->nullable();
            $table->string('bonus', 100)->nullable();
            $table->string('currency', 10)->nullable()->default('$');
            // FOREIGN KEYS
            $table->integer('company_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('taker_id')->unsigned();
            $table->integer('branch_id')->unsigned();
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
        Schema::dropIfExists('insurence');
    }
}
