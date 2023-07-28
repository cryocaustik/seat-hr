<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AllowQuestionDeletion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seat_hr_corporation_questions', function (Blueprint $table) {
            $table->dropForeign('seat_hr_corporation_questions_question_id_foreign');
            $table->foreign('question_id')
                ->references('id')
                ->on('seat_hr_questions')
                ->onDelete('cascade');
        });

        Schema::table('seat_hr_answers', function (Blueprint $table) {
            $table->dropForeign('seat_hr_answers_question_id_foreign');
            $table->foreign('question_id')
                ->references('id')
                ->on('seat_hr_questions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seat_hr_corporation_questions', function (Blueprint $table) {
            $table->dropForeign('seat_hr_corporation_questions_question_id_foreign');
            $table->foreign('question_id')
                ->references('id')
                ->on('seat_hr_questions')
                ->onDelete('restrict');
        });

        Schema::table('seat_hr_answers', function (Blueprint $table) {
            $table->dropForeign('seat_hr_answers_question_id_foreign');
            $table->foreign('question_id')
                ->references('id')
                ->on('seat_hr_questions')
                ->onDelete('restrict');
        });
    }
}
