<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('company_id')->nullable();
            $table->string('title', 255);
            $table->string('description', 255);
            $table->string('cover', 255);
            $table->string('token', 255);
            $table->enum('status', ['online','offline']);

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')->onDelete('cascade');
            
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
        Schema::dropIfExists('devices');
    }
}
