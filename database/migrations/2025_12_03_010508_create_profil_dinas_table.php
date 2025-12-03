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
        Schema::create('profil_dinas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dinas');
            $table->string('sub_title')->nullable();
            $table->text('alamat_kantor')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('email')->nullable();
            $table->json('social_media_links')->nullable();
            $table->string('logo_tanpa_text')->nullable();
            $table->string('logo_dengan_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_dinas');
    }
};
