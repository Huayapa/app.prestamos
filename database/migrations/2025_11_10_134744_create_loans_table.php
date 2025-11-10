<?php

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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrower_id')->constrained('users')->onDelete('cascade');
            $table->string('student_id', 50);
            $table->foreignId('book_id')->nullable()->constrained('books')->nullOnDelete();
            $table->date('due_date');
            $table->date('return_date')->nullable();
            $table->enum('loan_status', ['Pendiente', 'Devuelto', 'Atrasado', 'Perdido'])->default('Pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
