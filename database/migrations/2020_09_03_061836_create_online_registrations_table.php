<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_type');//studen or alumni or other
            $table->string('full_name');
            $table->string('degree')->nullable();
            $table->string('learning_stream')->nullable();
            $table->string('master_name')->nullable();
            $table->string('year')->nullable();
            $table->string('group')->nullable();
            $table->string('email', 100)->unique();
            $table->string('telephone');
            $table->string('request_type');
            $table->string('request_file')->nullable();
            $table->text('message');
            $table->softDeletes();
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
        Schema::dropIfExists('online_registrations');
    }
}
