<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // This migration is intentionally a no-op.
        // The wrong_answers table is created by 2026_02_26_120200_create_wrong_answers_table.php.
    }

    public function down(): void
    {
        // No-op to avoid dropping a table created by the earlier migration.
    }
};
