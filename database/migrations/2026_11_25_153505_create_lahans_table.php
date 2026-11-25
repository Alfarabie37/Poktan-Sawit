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
    Schema::create('lahans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('petani_id')->constrained('petanis')->onDelete('cascade');
        $table->string('kode_lahan')->unique();
        $table->string('lokasi');
        $table->decimal('luas_hektar', 8, 2);
        $table->string('jenis_bibit');
        $table->integer('tahun_tanam');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lahans');
    }
};
