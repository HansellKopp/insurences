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
            $table->string('number')->unique();
            $table->date('from');
            $table->date('to');
            $table->string('pay_form')->nullable();
            $table->double('amount', 15, 8)->nullable();
            $table->double('gainings', 15, 8)->nullable();
            $table->double('bonus', 15, 8)->nullable();
            $table->string('currency')->nullable()->default('$');
            $table->integer('company_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('taker_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned();
            $table->timestamps();
             // FOREIGN KEYS
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('taker_id')->references('id')->on('takers');
            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurences');
    }
}
