<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('room_id')->references('id')
                ->on('rooms')->onDelete('cascade');
            $table->foreign('author_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->foreign('status_id')->references('id')
                ->on('task_statuses')->onDelete('cascade');
            $table->foreign('type_id')->references('id')
                ->on('task_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
        });
    }
};
