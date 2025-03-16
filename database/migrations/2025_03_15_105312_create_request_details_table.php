<?php

use App\Models\Category;
use App\Models\Request;
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
        Schema::create('request_details', function (Blueprint $table) {
            $table->uuid('request_detail_id')->primary();
            $table->string('request_code');
            $table->foreign('request_code')->references('request_code')->on('requests')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('category_id')->references('category_id')->on('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_details');
    }
};
