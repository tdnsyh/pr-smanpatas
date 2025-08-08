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
        Schema::create('alumni_privasi', function (Blueprint $table) {
            $table->id();
            $table->uuid('alumni_id');
            $table->foreign('alumni_id')->references('id')->on('alumni')->onDelete('cascade');
            $table->string('kolom'); // contoh: 'email', 'no_hp'
            $table->boolean('is_public')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_privasi');
    }
};
