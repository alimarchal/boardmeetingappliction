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
        Schema::create('committee_meeting_comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained();

            // Old: $table->foreignUuid('committee_meeting_id')->constrained();
            // New: Explicitly naming the foreign key constraint
            $table->foreignUuid('committee_meeting_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->name('fk_comment_meeting');

            // Old: $table->foreignUuid('committee_meeting_agenda_items_id')->nullable()->constrained();
            // New: Explicitly naming the foreign key constraint and shortening the column name
            $table->foreignUuid('committee_meeting_agenda_item_id')
                ->nullable()
                ->constrained('committee_meeting_agenda_items')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->name('fk_comment_agenda_item');

            $table->string('description');
            $table->string('path_attachment')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committee_meeting_comments');
    }
};