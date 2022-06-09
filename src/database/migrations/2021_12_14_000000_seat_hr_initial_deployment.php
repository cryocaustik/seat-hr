<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeatHrInitialDeployment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seat_hr_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->boolean('probation')->default(true);

            $table->timestamps();
        });

        Schema::create('seat_hr_corporations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('corporation_id');
            $table->foreign('corporation_id')
                ->references('corporation_id')
                ->on('corporation_infos')
                ->onDelete('restrict');

            $table->string('hr_head')->nullable();
            $table->boolean('has_restricted_questions')->default(false);
            $table->boolean('accepting_applications')->default(false);

            $table->timestamps();
        });

        Schema::create('seat_hr_applications', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('corporation_id');
            $table->foreign('corporation_id')
                ->references('id')
                ->on('seat_hr_corporations')
                ->onDelete('restrict');

            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')
                ->references('id')
                ->on('seat_hr_profiles')
                ->onDelete('cascade');

            $table->boolean('can_reapply')->default(false);

            $table->timestamps();
        });

        Schema::create('seat_hr_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->set('color', ['primary', 'secondary', 'success', 'warning', 'danger']);
            $table->boolean('active')->default(false);

            $table->timestamps();
        });

        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => '\Cryocaustik\SeatHr\database\seeders\SeatHrStatusSeeder',
        ]);

        Schema::create('seat_hr_application_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('application_id');
            $table->foreign('application_id')
                ->references('id')
                ->on('seat_hr_applications')
                ->onDelete('cascade');

            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')
                ->references('id')
                ->on('seat_hr_statuses')
                ->onDelete('cascade');

            $table->unsignedInteger('assigned_to')->nullable();
            $table->foreign('assigned_to')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unsignedInteger('assigned_by')->nullable();
            $table->foreign('assigned_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->boolean('active')->default(false);

            $table->timestamps();
        });

        Schema::create('seat_hr_questions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->set('type', ['boolean', 'date', 'datetime', 'string', 'text']);
            $table->boolean('active')->default(true);

            $table->timestamps();
        });

        Schema::create('seat_hr_corporation_questions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('corporation_id');
            $table->foreign('corporation_id')
                ->references('id')
                ->on('seat_hr_corporations')
                ->onDelete('cascade');

            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')
                ->references('id')
                ->on('seat_hr_questions')
                ->onDelete('restrict');

            $table->boolean('active')->default(true);

            $table->timestamps();
        });

        Schema::create('seat_hr_answers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('application_id');
            $table->foreign('application_id')
                ->references('id')
                ->on('seat_hr_applications')
                ->onDelete('cascade');

            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')
                ->references('id')
                ->on('seat_hr_questions')
                ->onDelete('restrict');

            $table->text('response');

            $table->timestamps();
        });

        Schema::create('seat_hr_notes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')
                ->references('id')
                ->on('seat_hr_profiles')
                ->onDelete('cascade');

            $table->unsignedInteger('created_by');
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->set('severity', ['info', 'warning', 'danger']);
            $table->text('note');

            $table->timestamps();
        });

        Schema::create('seat_hr_blacklists', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')
                ->references('id')
                ->on('seat_hr_profiles')
                ->onDelete('cascade');

            $table->string('blacklisted_by');
            $table->date('blacklisted_at')->useCurrent();
            $table->text('reason');

            $table->unsignedInteger('created_by');
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('seat_hr_kick_histories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')
                ->references('id')
                ->on('seat_hr_profiles')
                ->onDelete('cascade');

            $table->string('kicked_by');
            $table->date('kicked_at')->useCurrent();
            $table->string('reason');

            $table->unsignedInteger('created_by');
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

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
        Schema::dropIfExists('seat_hr_blacklists');
        Schema::dropIfExists('seat_hr_kick_histories');
        Schema::dropIfExists('seat_hr_notes');
        Schema::dropIfExists('seat_hr_answers');
        Schema::dropIfExists('seat_hr_corporation_questions');
        Schema::dropIfExists('seat_hr_questions');
        Schema::dropIfExists('seat_hr_application_statuses');
        Schema::dropIfExists('seat_hr_statuses');
        Schema::dropIfExists('seat_hr_applications');
        Schema::dropIfExists('seat_hr_corporations');
        Schema::dropIfExists('seat_hr_profiles');
    }
}
