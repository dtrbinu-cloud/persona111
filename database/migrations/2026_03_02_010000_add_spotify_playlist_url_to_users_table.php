<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('users', 'spotify_playlist_url')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('spotify_playlist_url')->nullable()->after('learning_character');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'spotify_playlist_url')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('spotify_playlist_url');
            });
        }
    }
};
