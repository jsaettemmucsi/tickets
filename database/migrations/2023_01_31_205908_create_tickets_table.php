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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->datetime('opened');
			$table->unsignedBigInteger('requester');
			$table->string('category')->nullable();
			$table->string('subcategory')->nullable();
			$table->unsignedBigInteger('businessservice_id')->nullable();
			$table->unsignedBigInteger('configurationitem_id')->nullable();
			$table->string('channel')->nullable();
			$table->string('status')->nullable();
			$table->string('impact')->nullable();
			$table->string('urgency')->nullable();
			$table->string('priority')->nullable();
			$table->unsignedBigInteger('owner_group')->nullable();
			$table->unsignedBigInteger('assignment_group')->nullable();
			$table->unsignedBigInteger('assigned_to')->nullable();
			$table->string('short_description')->nullable();
			$table->string('description')->nullable();
			$table->integer('active')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
