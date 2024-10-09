<?php
 use Illuminate\Database\Migrations\Migration;
 use Illuminate\Database\Schema\Blueprint;
 use Illuminate\Support\Facades\Schema;

 class CreateUserVouchersTable extends Migration
 {
     /**
      * Run the migrations.
      *
      * @return void
      */
     public function up()
     {
         Schema::create('user_vouchers', function (Blueprint $table) {
             $table->id(); // Tạo trường ID tự động tăng
             $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Khóa ngoại đến bảng users
             $table->foreignId('voucher_id')->constrained()->onDelete('cascade'); // Khóa ngoại đến bảng vouchers
             $table->timestamps(); // Thêm created_at và updated_at
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::dropIfExists('user_vouchers');
     }
 }
