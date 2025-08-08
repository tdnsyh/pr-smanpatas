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
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('alumni_id')->nullable()->after('id');

            // Kalau ingin foreign key relasi langsung ke tabel alumni:
            $table->foreign('alumni_id')
                  ->references('id')
                  ->on('alumni')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['alumni_id']);
            $table->dropColumn('alumni_id');
        });
    }
};
