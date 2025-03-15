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
            $table->uuid('inventoryId');
            $table->foreignIdFor(Category::class, 'categoryId')->constrained()->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->date('tanggalIvn');
            $table->bigInteger('jumlahIvn');
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
