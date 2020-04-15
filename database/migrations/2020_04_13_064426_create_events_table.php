<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name',150)->nullable();
            $table->text('event_description',1000)->nullable();
            $table->string('event_fname')->nullable();
            $table->enum('event_status', ['Active', 'Inactive'])->default('Active');
            $table->date('event_scheduled_date')->nullable();
            $table->time('event_scheduled')->nullable();
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
        Schema::dropIfExists('events');
    }
}
