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
        Schema::create('resep_obats', function (Blueprint $table) {
        $table->id();
        $table->foreignId('resep_id')->constrained()->onDelete('cascade');
        $table->foreignId('obatalkes_id')->constrained('obatalkes_m');
        $table->foreignId('signa_id')->constrained('signa_m');
        $table->integer('qty');
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep_obats');
    }
};
