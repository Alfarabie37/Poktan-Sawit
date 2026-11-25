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
    Schema::create('pupuks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('petani_id')->constrained('petanis')->onDelete('cascade');
        $table->date('tanggal_distribusi');
        $table->string('jenis_pupuk');
        $table->string('kategori'); // Subsidi / Non-Subsidi
        $table->integer('jumlah_sak');
        $table->decimal('berat_total_kg', 10, 2);
        $table->string('keterangan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pupuks');
    }
};
