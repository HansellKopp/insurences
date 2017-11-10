<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolicyDocument extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policy_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('document');
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
        Schema::drop('policy_documents');
    }
}
