<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('user_id');
            $table->integer('company_id');
            $table->text('details')->nullable();
            $table->dateTime('date_start')->nullable();
            $table->dateTime('date_finish');
            $table->integer('repeat_duration')->nullable();
            $table->string('repeat_type')->nullable();
            $table->integer('status')->default(0);
            $table->boolean('require_location')->default(false);
            $table->string('finish_location')->nullable();
            $table->string('location')->nullable();
            $table->string('completed_by')->nullable();
            $table->integer('created_by');
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
        Schema::dropIfExists('tasks');
    }
}
