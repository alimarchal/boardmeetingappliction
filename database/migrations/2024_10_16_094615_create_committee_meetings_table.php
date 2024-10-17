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
        Schema::create('committee_meetings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('me_id')->unique();
            $table->foreignId('user_id')->constrained();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('date_and_time')->nullable();
            $table->string('location')->nullable();
            $table->string('path_attachment')->nullable();
            $table->enum('meeting_status', ['Digital', 'Manual'])->default('Digital');
            $table->enum('status', ['Lock', 'Unlock'])->default('Lock');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committee_meetings');
    }
};
