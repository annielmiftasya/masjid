<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infaqs', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->unsignedInteger('user_id');
            $table->bigInteger('amount');
            $table->text('pray')->nullable();
            $table->string('snap_token')->nullable();
            $table->enum('status', array('pending', 'success', 'expired', 'failed'));
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
        Schema::dropIfExists('infaqs');
    }
}
