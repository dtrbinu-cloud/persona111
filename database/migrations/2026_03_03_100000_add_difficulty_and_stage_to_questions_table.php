<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            if (! Schema::hasColumn('questions', 'difficulty')) {
                $table->string('difficulty', 20)->default('easy')->after('type');
            }
            if (! Schema::hasColumn('questions', 'stage')) {
                $table->unsignedInteger('stage')->default(1)->after('difficulty');
            }
        });

        $map = [
            'grammar' => 'easy',
            'vocabulary' => 'medium',
            'context' => 'hard',
        ];

        foreach ($map as $type => $difficulty) {
            $ids = DB::table('questions')
                ->where('type', $type)
                ->orderBy('id')
                ->pluck('id')
                ->all();

            foreach ($ids as $index => $id) {
                DB::table('questions')
                    ->where('id', $id)
                    ->update([
                        'difficulty' => $difficulty,
                        'stage' => (int) floor($index / 3) + 1,
                    ]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            if (Schema::hasColumn('questions', 'stage')) {
                $table->dropColumn('stage');
            }
            if (Schema::hasColumn('questions', 'difficulty')) {
                $table->dropColumn('difficulty');
            }
        });
    }
};
