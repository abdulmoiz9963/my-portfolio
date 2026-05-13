<?php
// ====================================================
// Migration: create_profiles_table.php
// ====================================================
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Abdul Moiz Ashraf');
            $table->string('email')->default('moiz9963@gmail.com');
            $table->string('phone')->nullable();
            $table->string('location')->nullable()->default('Lahore, Pakistan');
            $table->string('tagline')->nullable();
            $table->text('about')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('cv_path')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('profiles'); }
};
