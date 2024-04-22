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
        Schema::create('meetings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('me_id')->unique();
            $table->foreignId('user_id')->constrained();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('date_and_time')->nullable();
            $table->string('location')->nullable();
            $table->string('path_attachment')->nullable();
            $table->enum('status', ['Lock', 'Unlock'])->default('Lock');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::unprepared('
            CREATE TRIGGER meetings_me_id_trigger
            BEFORE INSERT ON meetings
            FOR EACH ROW
            SET NEW.me_id = IFNULL(
                (SELECT MAX(me_id) + 1 FROM meetings WHERE me_id >= 75),
                75
            )
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
