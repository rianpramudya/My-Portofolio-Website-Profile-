<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pastikan tabel dibuat dengan kolom-kolom lengkap ini
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // <--- Kolom ini yang tadi error (hilang)
            $table->string('headline');
            $table->text('about_text');
            $table->string('cv_link')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email')->nullable();
            $table->string('github_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};