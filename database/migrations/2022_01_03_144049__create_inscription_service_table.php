<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscriptionServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscription_service', function (Blueprint $table)
        {
            $table->id();
            $table->timestamps();
            $table->integer('inscription_id');
            $table->integer('service_id');
        });
    }

}
