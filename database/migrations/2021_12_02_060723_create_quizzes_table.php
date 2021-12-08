<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('points')->default(0);
            $table->integer('subject_id')->unsigned()
                ->references('id')
                ->on('subjects')
                ->onDelete('cascade')
                ->nullable();
            $table->integer('course_id')->unsigned()
                ->references('id')
                ->on('courses')
                ->onDelete('cascade')
                ->nullable();
            $table->integer('lesson_id')->unsigned()
                ->references('id')
                ->on('lessons')
                ->onDelete('cascade')
                ->nullable();;
            $table->boolean('is_free')->default(0);
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
        Schema::dropIfExists('quizzes');
    }
}
