<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string("code");
            $table->string("title");
            $table->string("description");
            $table->string("type");
            $table->unsignedBigInteger("user");
            $table->integer("city");
            $table->string("location");
            $table->timestamp("start");
            $table->timestamp("end");
            $table->timestamps();
            $table->foreign('user')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
};
