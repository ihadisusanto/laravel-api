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
        Schema::create('episodes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('anime_id')->constrained(
                table: 'animes',
                indexName: 'episodes_anime_id'
            );
            $table->integer('num_episode');
            $table->string('episode_title');
            $table->string('link');
            $table->string('duration');
            $table->string('is_premium');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE episodes ALTER COLUMN id SET DEFAULT gen_random_uuid();');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
