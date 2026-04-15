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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username'); //tên đăng nhập
            $table->string('password')->nullable(); //nếu cần
            $table->string('price');
            $table->string('image')->nullable(); //ảnh
            $table->string('description')->nullable(); // mô tả
            $table->string('status')->default('active'); // trạng thái
            $table->foreignId('category_id')
            ->constrained()
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
