<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worknotes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->unsignedBigInteger('ticket_id');
			$table->unsignedBigInteger('user_id');
			$table->integer('internal')->default(1);
			$table->longText('body')->nullable();
			$table->string('type')->nullable();
			$table->longText('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('worknotes');
    }
};
