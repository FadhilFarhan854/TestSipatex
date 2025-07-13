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
        Schema::create('resep_racikans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('resep_id')->constrained()->onDelete('cascade');
        $table->string('nama_racikan');
        $table->foreignId('signa_id')->constrained('signa_m');
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep_racikans');
    }
};
