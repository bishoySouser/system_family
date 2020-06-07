<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('father_id')->unique(); // individuals->id;
            $table->unsignedBigInteger('mather_id')->unique(); // individuals->id;
            $table->date('family_date_from')->nullable();
            $table->timestamps();

            //foreign key
            $table->foreign('father_id')->references('id')->on('individuals');
            $table->foreign('mather_id')->references('id')->on('individuals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('families');
    }
}
