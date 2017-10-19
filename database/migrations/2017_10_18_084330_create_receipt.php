<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceipt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 100);
            $table->unique('number');
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->double('amount', 15, 8)->nullable();
            $table->timestamps();
            // FOREIGN KEY
            $table->integer('insurence_id')->unsigned();
            $table->foreign('insurence_id')->references('id')->on('insurences')->onDelete('cascade');
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
