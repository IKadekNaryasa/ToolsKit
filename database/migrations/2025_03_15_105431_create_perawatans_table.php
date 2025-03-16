<?php

use App\Models\MntTool;
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
        Schema::create('perawatan', function (Blueprint $table) {
            $table->uuid('perawatan_id')->primary();
            $table->string('kode_alat');
            $table->foreign('kode_alat')->references('kode_alat')->on('mnt_tools')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggal_perawatan');
            $table->date('tanggal_selesai');
            $table->text('description');
            $table->enum('status', ['on progres', 'done']);
            $table->string('biaya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perawatan');
    }
};
