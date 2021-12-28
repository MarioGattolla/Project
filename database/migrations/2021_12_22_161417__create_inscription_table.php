<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptions', function (Blueprint $table)
        {
            $table->id();
            $table->timestamps();
            $table->integer('time');
            $table->date('start');
            $table->integer('user_id');
            $table->integer('service_id');
        });
    }


}
