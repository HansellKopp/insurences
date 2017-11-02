<?php

use App\Insurance;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsurances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number')->unique();
            $table->date('from');
            $table->date('to');
            $table->string('pay_form')->default(Insurances::CASH);
            $table->double('amount', 15, 2)->nullable();
            $table->double('gains', 15, 2)->nullable();
            $table->double('bonus', 15, 2)->nullable();
            $table->string('currency')->nullable()->default('$');
            $table->integer('company_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('taker_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
             // FOREIGN KEYS
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('taker_id')->references('id')->on('clients');
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
        Schema::dropIfExists('insurances');
    }
}