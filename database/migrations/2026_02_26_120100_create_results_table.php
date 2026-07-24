<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('score');
            $table->unsignedInteger('xp');
            $table->unsignedInteger('grammar_score')->default(0);
            $table->unsignedInteger('vocabulary_score')->default(0);
            $table->unsignedInteger('context_score')->default(0);
            $table->string('character');
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
