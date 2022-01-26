<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coach_service',function (Blueprint $table)
        {
           $table->id();
           $table->foreignId('coach_id')->nullable()->constrained('coaches')->nullOnDelete();
           $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
           $table->timestamps();
        });
    }
}
