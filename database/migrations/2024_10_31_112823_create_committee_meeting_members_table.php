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
        Schema::create('committee_meeting_members', function (Blueprint $table) {
            $table->id();
            // created by (referencing users table)
            $table->foreignId('created_by_id')->constrained('users');
            // committee meeting reference
            $table->foreignUuid('committee_meeting_id')->nullable()->constrained('committee_meetings')->onDelete('set null')->onUpdate('cascade');
            // member reference
            $table->foreignId('user_id')->constrained('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committee_meeting_members');
    }
};
