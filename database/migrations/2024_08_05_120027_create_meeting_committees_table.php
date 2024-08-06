<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meeting_committees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('type')->nullable(); // e.g., Human Resource, Audit, Risk Management, IT
            $table->timestamps();
        });

        // Insert initial committee records
        DB::table('meeting_committees')->insert([
            [
                'name' => 'Human Resource Committee, of BoD',
                'type' => 'Human Resource',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Audit Committee of BoD',
                'type' => 'Audit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Risk Management Committee of BoD',
                'type' => 'Risk Management',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'I.T Committee of BoD',
                'type' => 'IT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);



        Schema::create('committee_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('committee_id')->constrained('meeting_committees')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('position'); // e.g., Chairman, Member, Secretary
            $table->timestamps();
        });

        Schema::create('committee_meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('committee_id')->constrained('meeting_committees')->onDelete('cascade');
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
        Schema::dropIfExists('committee_members');
        Schema::dropIfExists('meeting_committees');
    }
};
