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
    // Bảng ticket lưu thông tin yêu cầu dịch vụ và trạng thái xử lý.
    Schema::create('service_requests', function (Blueprint $table) {

        $table->id();

        $table->foreignId('user_id')->nullable();

        $table->string('platform');

        $table->string('service');

        $table->string('contact')->nullable();

        $table->text('account_info')->nullable();

        $table->text('description')->nullable();

        $table->enum('status', [
            'pending',
            'processing',
            'done'
        ])->default('pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
