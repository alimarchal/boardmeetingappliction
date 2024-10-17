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
        Schema::create('committee_meeting_agenda_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid(column: 'committee_meeting_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->text('description');
            $table->integer('order');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committee_meeting_agenda_items');
    }
};