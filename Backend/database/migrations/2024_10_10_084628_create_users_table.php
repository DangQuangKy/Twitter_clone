<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Tạo cột id
            $table->string('name'); // Tạo cột name
            $table->string('email')->unique();
            $table->string('avatar')->nullable(); 
            $table->timestamp('email_verified_at')->nullable(); // Cột xác minh email
            $table->string('password');// Cột password
            $table->string('role')->default('user'); 
            $table->rememberToken(); // Cột token nhớ đăng nhập
            $table->timestamps(); // Cột created_at và updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users'); // Xóa bảng users
    }
}
