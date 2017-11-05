<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceipts extends Migration
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
            $table->string('number')->unique();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->double('amount', 15, 2)->nullable();
            $table->integer('policy_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            // FOREIGN KEY
            $table->foreign('policy_id')->references('id')->on('policies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('receipts');
    }
}
