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
    Schema::create('panens', function (Blueprint $table) {
        $table->id();
        $table->foreignId('lahan_id')->constrained('lahans')->onDelete('cascade');
        $table->date('tanggal_panen');
        $table->decimal('berat_kg', 10, 2);
        $table->decimal('harga_per_kg', 10, 2);
        $table->decimal('total_pendapatan', 15, 2);
        $table->string('keterangan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panens');
    }
};
