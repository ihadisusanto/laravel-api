<?php
use Illuminate\Support\Facades\DB;
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
        Schema::create('animes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title_japan');
            $table->string('title_english');
            $table->string('slug')->unique();
            $table->integer('episodes');
            $table->integer('release_year');
            $table->string('genre');
            $table->string('studios');
            $table->string('image_url');
            $table->text('description');
            $table->string('status'); // ongoing, completed, cancelled, or dropped
            $table->float('rating');
            $table->timestamps();
        });
        // Use raw SQL to set default for id to gen_random_uuid() for PostgreSQL
        DB::statement('ALTER TABLE animes ALTER COLUMN id SET DEFAULT gen_random_uuid();');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animes');
    }
};
