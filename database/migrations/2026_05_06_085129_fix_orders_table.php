<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('orders', function (Blueprint $table) {

        if (!Schema::hasColumn('orders', 'account_id')) {
            $table->unsignedBigInteger('account_id')->nullable();
        }

        if (!Schema::hasColumn('orders', 'price')) {
            $table->decimal('price', 15, 2)->nullable();
        }

        if (!Schema::hasColumn('orders', 'status')) {
            $table->string('status')->default('pending');
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn(['account_id', 'price', 'status']);
    });
    }
};
