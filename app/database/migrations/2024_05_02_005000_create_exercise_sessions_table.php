<?php

use Illuminate\Support\Str;
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
        Schema::create('exercise_sessions', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(Str::uuid());
            $table->foreignId('user_id')->constrained();
            $table->enum('type', ['practice', 'assessment']);
            $table->uuid('practice_id')
                  ->nullable();
            $table->uuid('assessment_id')
                  ->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamp('start_time')->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('end_time')->nullable();
            $table->boolean('is_completed')->default(0);
            $table->timestamps();

            $table->foreign('practice_id')->references('id')->on('practices')->onDelete('cascade');
            $table->foreign('assessment_id')->references('id')->on('assessments')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_sessions');
    }
};
