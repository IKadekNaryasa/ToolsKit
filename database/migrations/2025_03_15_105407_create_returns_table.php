<?php

use App\Models\User;
use App\Models\Peminjaman;
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
        Schema::create('returns', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('borrowing_code');
            $table->foreign('borrowing_code')->references('borrowing_code')->on('borrowings')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('return_date');
            $table->text('notes');
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status', ['requested', 'approved', 'rejected']);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returns');
    }
};
