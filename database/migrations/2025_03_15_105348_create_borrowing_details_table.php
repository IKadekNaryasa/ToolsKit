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
        Schema::create('borrowing_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('borrowing_code');
            $table->foreign('borrowing_code')->references('borrowing_code')->on('borrowings')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('tool_code');
            $table->foreign('tool_code')->references('tool_code')->on('tools')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_details');
    }
};
