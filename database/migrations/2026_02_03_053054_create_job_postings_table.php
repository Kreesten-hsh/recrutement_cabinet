<?php

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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('status', ['en_cours', 'cloture'])->default('en_cours');
            $table->enum('type', ['CDD', 'CDI', 'Stage', 'Freelance']);
            $table->text('description');
            $table->json('attributions')->nullable();
            $table->text('competences')->nullable();
            $table->string('diplome')->nullable();
            $table->string('experience')->nullable();
            $table->json('aptitudes')->nullable();
            $table->json('pieces_required')->nullable();
            $table->string('document_path')->nullable();
            $table->timestamp('published_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
