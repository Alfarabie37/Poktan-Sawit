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
        // 1. Tambah role & status pada tabel users
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['super_admin', 'pengurus'])->default('pengurus')->after('email');
            $table->enum('status', ['menunggu', 'aktif', 'nonaktif'])->default('menunggu')->after('role');
        });

        // 2. Buat tabel profil kelompok tani (1 akun pengurus = 1 kelompok tani)
        Schema::create('kelompok_tanis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_kelompok');
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('nama_ketua');
            $table->integer('tahun_berdiri');
            $table->string('no_hp');
            $table->text('alamat_sekretariat')->nullable();
            $table->enum('status_verifikasi', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });

        // 3. Hubungkan tabel petanis ke kelompok_tanis & tambah jabatan
        Schema::table('petanis', function (Blueprint $table) {
            $table->foreignId('kelompok_tani_id')->nullable()->after('id')->constrained('kelompok_tanis')->onDelete('cascade');
            $table->string('jabatan')->default('Anggota')->after('nama_petani');
            $table->date('tanggal_bergabung')->nullable()->after('alamat');
        });

        // 4. Tambah kolom status_legalitas pada tabel lahans
        Schema::table('lahans', function (Blueprint $table) {
            $table->string('status_legalitas')->default('Belum lengkap')->after('tahun_tanam');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lahans', function (Blueprint $table) {
            $table->dropColumn('status_legalitas');
        });

        Schema::table('petanis', function (Blueprint $table) {
            $table->dropForeign(['kelompok_tani_id']);
            $table->dropColumn(['kelompok_tani_id', 'jabatan', 'tanggal_bergabung']);
        });

        Schema::dropIfExists('kelompok_tanis');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'status']);
        });
    }
};
