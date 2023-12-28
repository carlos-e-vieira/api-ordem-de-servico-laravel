<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->enum('document_type', ['cpf', 'cnpj']);
            $table->string('document_number', 14)->unique();
            $table->string('email', 60)->unique();
            $table->string('phone', 11);
            $table->string('company_name', 40);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
