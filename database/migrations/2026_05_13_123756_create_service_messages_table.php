<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Bảng hội thoại của ticket, hỗ trợ ba loại người gửi: user, admin và AI.
        Schema::create('service_messages', function (Blueprint $table) {

            $table->id();

            $table->foreignId('service_request_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->text('message');

            $table->enum('sender', [
                'user',
                'admin',
                'ai'
            ]);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_messages');
    }
};
