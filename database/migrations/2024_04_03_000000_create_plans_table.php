<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Plans', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('title', 100);
            $table->decimal('price');
            $table->integer('amount');
            $table->enum('type',['day','month','year']);
            $table->integer('user_limit');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Plans');
    }
}
