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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tool_code');
            $table->foreign('tool_code')->references('tool_code')->on('tools')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('maintenance_date');
            $table->date('completion_date')->nullable();
            $table->text('description');
            $table->enum('status', ['in_progress', 'done'])->default('in_progress');
            $table->bigInteger('cost')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
