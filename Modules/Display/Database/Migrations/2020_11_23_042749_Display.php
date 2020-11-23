<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Display extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('displays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('display_id');
            $table->string('display_name');
            $table->string('authorized');
            $table->string('logged_in');
            $table->string('default_layout');
            $table->string('last_accessed');
            $table->string('ip_address');
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
        Schema::dropIfExists('displays');
    }
}
