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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->string('name');
			$table->string('description')->nullable();
			$table->string('email')->nullable();
			$table->integer('active')->default(1);
			$table->unsignedBigInteger('owner_id')->nullable();
			$table->longText('logo')->nullable();
			$table->text('logourl')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
};
