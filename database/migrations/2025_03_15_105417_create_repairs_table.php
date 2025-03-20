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
        Schema::create('repairs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tool_code');
            $table->foreign('tool_code')->references('tool_code')->on('tools')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('repair');
            $table->date('completion_date')->nullable();
            $table->text('description');
            $table->enum('status', ['in_progress', 'done'])->default('in_progress');
            $table->decimal('cost', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
