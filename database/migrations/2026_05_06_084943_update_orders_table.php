<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {

            // thêm cột nếu chưa có
            if (!Schema::hasColumn('orders', 'account_id')) {
                $table->unsignedBigInteger('account_id')->nullable();
            }

            if (!Schema::hasColumn('orders', 'price')) {
                $table->decimal('price', 15, 2)->nullable();
            }

            if (!Schema::hasColumn('orders', 'status')) {
                $table->string('status')->default('pending');
            }

            // foreign key (chỉ thêm nếu chưa có)
        });
    }

    public function down(): void
    {
        //
    }
};
