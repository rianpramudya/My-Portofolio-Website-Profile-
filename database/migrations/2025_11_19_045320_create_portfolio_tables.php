<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Skills (Keahlian)
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');         // Contoh: Laravel, React
            $table->string('category');     // Contoh: Backend, Frontend, Tools
            $table->integer('proficiency'); // 1-100 (Persentase)
            $table->string('icon')->nullable(); // Class icon (Phosphor)
            $table->timestamps();
        });

        // 2. Tabel Experiences (Pengalaman)
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('role');         // Contoh: Senior Backend Dev
            $table->string('company');      // Contoh: Google Indonesia
            $table->string('period');       // Contoh: 2022 - Present
            $table->text('description');    // Deskripsi pekerjaan
            $table->string('type')->default('work'); // work / education
            $table->timestamps();
        });

        // 3. Tabel Services (Layanan)
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');        // Contoh: API Development
            $table->text('description');
            $table->string('icon');         // Icon class
            $table->timestamps();
        });

        // 4. Update Tabel Projects (Jika belum ada kolom ini, tambahkan)
        // Karena kita merombak, kita pastikan strukturnya seperti ini:
        if (!Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('category');
                $table->text('description');
                $table->string('image')->nullable();
                $table->string('link_url')->nullable();
                $table->string('tech_stack')->nullable(); // JSON: ["Laravel", "Vue"]
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('services');
        Schema::dropIfExists('projects');
    }
};