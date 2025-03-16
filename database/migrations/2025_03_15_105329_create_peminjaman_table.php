<?php

use App\Models\User;
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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->string('peminjaman_code')->primary();
            $table->foreignUuid('user_id')->references('user_id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_kembali');
            $table->text('keterangan');
            $table->enum('status', ['dipinjam', 'pengajuan_pengembalian', 'dikembalikan'])->default('dipinjam');
            $table->foreignUuid('by_admin')->references('user_id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
