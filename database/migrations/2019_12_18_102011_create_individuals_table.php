<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individuals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name',50);
            $table->string('middle_name',50);
            $table->string('last_name',50);
            $table->enum('gander',['male', 'female']);
            $table->date('date_of_birth');
            $table->integer('age');
            $table->date('date_of_death')->nullable();
            $table->string('place_of_birth',50);
            $table->string('email',255)->nullable();
            $table->string('area',50);
            $table->string('address',100);
            $table->string('home_phone',22);
            $table->string('mobile_phone1',22);
            $table->string('mobile_phone2',22)->nullable();
            $table->string('job',50)->nullable();
            $table->boolean('is_a_married')->default(0);
            $table->boolean('special')->nullable();
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
        Schema::dropIfExists('individuals');
    }
}
