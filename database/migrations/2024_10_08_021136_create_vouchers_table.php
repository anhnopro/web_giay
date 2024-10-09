<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id(); // Khóa chính
            $table->string('code')->unique(); // Mã voucher, duy nhất
            $table->enum('discount_type', ['percentage', 'fixed']); // Loại giảm giá
            $table->decimal('discount_amount', 8, 2); // Số lượng giảm giá
            $table->text('description')->nullable(); // Mô tả, tùy chọn
            $table->date('expiration_date'); // Ngày hết hạn
            $table->integer('usage_limit')->nullable(); // Giới hạn sử dụng, null là không giới hạn
            $table->integer('usage_count')->default(0); // Số lần đã sử dụng
            $table->enum('status', ['active', 'inactive'])->default('active'); // Trạng thái
            $table->timestamps(); // created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}

