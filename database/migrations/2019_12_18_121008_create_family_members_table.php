<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('family_id'); //families->id
            $table->unsignedBigInteger('individual_id'); //individuals->id
            $table->enum('role',['mother','son','daughter']);
            $table->timestamps();
            //foreign key
            $table->foreign('family_id')->references('id')->on('families');
            $table->foreign('individual_id')->references('id')->on('individuals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_members');
    }
}
