<?php

use App\Models\MntTool;
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
        Schema::create('perbaikan', function (Blueprint $table) {
            $table->uuid('perbaikan_id')->primary();
            $table->string('kode_alat');
            $table->foreign('kode_alat')->references('kode_alat')->on('mnt_tools')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggal_perbaikan');
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
        Schema::dropIfExists('perbaikan');
    }
};
