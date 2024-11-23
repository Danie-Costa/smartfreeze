<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('company_id')->nullable();
            $table->integer('device_id')->nullable();
            $table->text('description');

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')->onDelete('cascade');

            $table->foreign('device_id')
                ->references('id')
                ->on('devices')->onDelete('cascade');
            
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
        Schema::dropIfExists('records');
    }
}
