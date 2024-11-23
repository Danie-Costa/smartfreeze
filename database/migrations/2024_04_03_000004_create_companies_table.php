<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {

            $table->integer('id')->autoIncrement();
            $table->integer('plan_id');
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();

            $table->string('name');
            $table->string('corporate_name')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('logo')->nullable();

            $table->string('cep')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();

            $table->dateTime('final_date');
            $table->dateTime('initial_date');

            $table->enum('status',['active','inactive']);

            $table->string('corporate_email')->nullable();


            $table->foreign('plan_id')
                ->references('id')
                ->on('plans')->onDelete('cascade');

            $table->foreign('state_id')
                ->references('id')
                ->on('states')->onDelete('cascade');

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')->onDelete('cascade');

          

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
        Schema::dropIfExists('companies');
    }
}
