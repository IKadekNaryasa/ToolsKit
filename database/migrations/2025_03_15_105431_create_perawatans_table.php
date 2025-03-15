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
            $table->uuid('pearwatanId');
            $table->foreignIdFor(MntTool::class, 'kodeAlat')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggalPerawatan');
            $table->date('tanggalSelesai');
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
