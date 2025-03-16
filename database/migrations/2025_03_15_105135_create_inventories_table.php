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
        Schema::create('inventories', function (Blueprint $table) {
            $table->uuid('inventory_id')->primary();
            $table->foreignUuid('category_id')->references('category_id')->on('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggal_ivn');
            $table->bigInteger('jumlah_ivn');
            $table->string('vendor');
            $table->text('keterangan');
            $table->string('harga');
            $table->string('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
