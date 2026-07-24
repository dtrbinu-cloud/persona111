<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'username')) {
                $table->string('username')->nullable()->after('id');
            }
            if (! Schema::hasColumn('users', 'xp')) {
                $table->unsignedInteger('xp')->default(0)->after('password');
            }
            if (! Schema::hasColumn('users', 'level')) {
                $table->unsignedInteger('level')->default(1)->after('xp');
            }
            if (! Schema::hasColumn('users', 'streak')) {
                $table->unsignedInteger('streak')->default(0)->after('level');
            }
            if (! Schema::hasColumn('users', 'learning_character')) {
                $table->string('learning_character')->nullable()->after('streak');
            }
            if (! Schema::hasColumn('users', 'last_login')) {
                $table->timestamp('last_login')->nullable()->after('learning_character');
            }
        });

    }

    public function down(): void
    {
        if (! Schema::hasTable('users')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'last_login')) {
                $table->dropColumn('last_login');
            }
            if (Schema::hasColumn('users', 'learning_character')) {
                $table->dropColumn('learning_character');
            }
            if (Schema::hasColumn('users', 'streak')) {
                $table->dropColumn('streak');
            }
            if (Schema::hasColumn('users', 'level')) {
                $table->dropColumn('level');
            }
            if (Schema::hasColumn('users', 'xp')) {
                $table->dropColumn('xp');
            }
            if (Schema::hasColumn('users', 'username')) {
                $table->dropColumn('username');
            }
        });
    }
};
