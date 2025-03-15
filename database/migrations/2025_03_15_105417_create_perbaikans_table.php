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
            $table->uuid('perbaikanId');
            $table->foreignIdFor(MntTool::class, 'kodeAlat')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggalPerbaikan');
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
        Schema::dropIfExists('perbaikan');
    }
};
