<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * This migration was created to prevent errors caused by deleting a user,
 * which would then delete all records of status set by that user.
 * Changed the behavior to instead set the assigned_to and assigned_by
 * to null on user deletion.
 */
class PreventApplicationStatusDeletion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('seat_hr_application_statuses', function (Blueprint $table): void {
            $table->dropForeign('seat_hr_application_statuses_assigned_by_foreign');
            $table->dropForeign('seat_hr_application_statuses_assigned_to_foreign');

            $table->foreign('assigned_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('assigned_to')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('seat_hr_application_statuses', function (Blueprint $table): void {
            $table->dropForeign('seat_hr_application_statuses_assigned_by_foreign');
            $table->dropForeign('seat_hr_application_statuses_assigned_to_foreign');

            $table->foreign('assigned_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('assigned_to')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }
}
