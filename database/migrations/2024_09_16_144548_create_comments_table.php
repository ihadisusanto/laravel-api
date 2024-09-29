<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained(
                table: 'users',
                indexName: 'comments_user_id'
            );
            $table->foreignUuid('episode_id')->constrained(
                table: 'episodes',
                indexName: 'comments_episode_id'
            );
            $table->text('comment');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE animes ALTER COLUMN id SET DEFAULT gen_random_uuid();');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
