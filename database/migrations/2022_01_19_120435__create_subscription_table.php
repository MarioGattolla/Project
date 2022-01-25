<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions',function (Blueprint $table)
    {
        $table->id();
        $table->date('start');
        $table->date('end');
        $table->timestamps();
    });
    }


}
