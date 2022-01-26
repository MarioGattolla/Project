<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaches', function (Blueprint $table){
           $table->id();
           $table->string('name');
           $table->string('surname');
           $table->string('phone');
           $table->string('email');
           $table->integer('age');
           $table->date('birthday');
           $table->timestamps();
        });
    }


}
