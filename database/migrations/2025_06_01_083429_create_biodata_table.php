<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('biodata', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('foto')->nullable(); // bisa URL/path gambar JPG
        $table->string('universitas')->nullable();
        $table->json('link_tautan')->nullable(); // linkedin, behance, github, dll
        $table->text('summary')->nullable();

        // ORGANIZATIONAL EXPERIENCE
        $table->json('organizational_experience')->nullable(); 
        // format JSON: [{ posisi, penjelasan, tahun, organisasi, lokasi }, ...]

        // VOLUNTEER EXPERIENCE
        $table->json('volunteer_experience')->nullable(); 
        // format JSON: [{ posisi, penjelasan, tahun, acara, lokasi }, ...]

        // EDUCATION
        $table->json('education')->nullable(); 
        // format JSON: [{ universitas, tahun_masuk, tahun_keluar, penjelasan, lokasi }, ...]

        // ACHIEVEMENT
        $table->json('achievement')->nullable(); 
        // format JSON: [{ judul, penjelasan }, ...]

        // ADDITIONAL INFORMATION
        $table->text('additional_information')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodata');
    }
};
