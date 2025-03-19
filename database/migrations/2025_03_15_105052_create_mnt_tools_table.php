<?php

use App\Models\Category;
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
        Schema::create('mnt_tools', function (Blueprint $table) {
            $table->string('tool_code')->primary();
            $table->string('name');
            $table->text('condition');
            $table->enum('status', ['available', 'borrowed', 'maintenance', 'repair', 'damaged'])->default('available');
            $table->foreignUuid('category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mnt_tools');
    }
};
