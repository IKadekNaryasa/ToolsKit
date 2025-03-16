<?php

use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->uuid('pengembalian_id')->primary();
            $table->string('peminjaman_code');
            $table->foreign('peminjaman_code')->references('peminjaman_code')->on('peminjaman')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggal_kembali');
            $table->text('keterangan');
            $table->foreignUuid('user_id')->references('user_id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status', ['diajukan', 'disetujui', 'ditolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
