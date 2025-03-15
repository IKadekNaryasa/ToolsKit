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
            $table->string('peminjamanCode')->primary();
            $table->foreignIdFor(User::class, 'userId')->constrained()->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->date('tanggalPeminjaman');
            $table->date('tanggalKembali');
            $table->text('keterangan');
            $table->enum('status', ['dipinjam', 'pengajuan_pengembalian', 'dikembalikan'])->default('dipinjam');
            $table->foreignIdFor(User::class, 'byAdmin')->constrained()->onDelete('CASCADE')->onUpdate('CASCADE');
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
