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
            $table->string('namaAlat')->primary();
            $table->string('kodeAlat')->unique();
            $table->text('kondisi');
            $table->enum('status', ['tersedia', 'dipinjam', 'perawatan', 'perbaikan', 'rusak'])->default('tersedia');
            $table->foreignIdFor(Category::class, 'categoryId')->constrained()->onDelete('CASCADE')->onUpdate('CASCADE');
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
