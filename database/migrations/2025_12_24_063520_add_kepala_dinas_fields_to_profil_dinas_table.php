<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profil_dinas', function (Blueprint $table) {
            $table->string('kepala_dinas_nama')->nullable();
            $table->string('kepala_dinas_foto')->nullable();
            $table->text('kepala_dinas_sambutan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil_dinas', function (Blueprint $table) {
            $table->dropColumn(['kepala_dinas_nama', 'kepala_dinas_foto', 'kepala_dinas_sambutan']);
        });
    }
};
