<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders_of_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('service_id');
            $table->enum('status', ['opened', 'in_progress', 'waiting_for_approval', 'completed', 'canceled']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('service_id')->references('id')->on('services');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders_of_service');
    }
};
