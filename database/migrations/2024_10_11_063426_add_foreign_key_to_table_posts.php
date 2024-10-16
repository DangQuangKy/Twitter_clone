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
        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('user_id') // Cột khóa ngoại trong bảng posts
                ->references('id') // Tham chiếu đến cột id của bảng users
                ->on('users') // Bảng users
                ->onDelete('cascade'); // Tùy chọn hành động khi xóa (ví dụ: cascade xóa bản ghi liên quan)
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Xóa ràng buộc khóa ngoại
        });
    }
};
