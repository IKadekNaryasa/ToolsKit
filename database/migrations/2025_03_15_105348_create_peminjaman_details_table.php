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
            $table->uuid('peminjamanDetailId');
            $table->foreignIdFor(Peminjaman::class, 'peminjamanCode')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(MntTool::class, 'kodeAlat')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
