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
            $table->uuid('pengembalianId');
            $table->foreignIdFor(Peminjaman::class, 'peminjamanCode')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggalKembali');
            $table->text('keterangan');
            $table->foreignIdFor(User::class, 'userId')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
