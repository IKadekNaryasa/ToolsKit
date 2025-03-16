<?php

use App\Models\MntTool;
use App\Models\Peminjaman;
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
        Schema::create('peminjaman_details', function (Blueprint $table) {
            $table->uuid('peminjaman_detail_id')->primary();
            $table->string('peminjaman_code');
            $table->foreign('peminjaman_code')->references('peminjaman_code')->on('peminjaman')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('kode_alat');
            $table->foreign('kode_alat')->references('kode_alat')->on('mnt_tools')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_details');
    }
};
