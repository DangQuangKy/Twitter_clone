<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Tạo cột id kiểu unsigned big integer
            $table->string('title'); // Tạo cột title kiểu chuỗi
            $table->text('content'); // Tạo cột content kiểu văn bản
            $table->string('image'); // Tạo cột image kiểu chuỗi
            $table->unsignedBigInteger('user_id')->nullable(); // Tạo cột user_id kiểu unsigned big integer
            $table->timestamps(); // Tạo cột created_at và updated_at
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Xóa khóa ngoại
        });
        Schema::dropIfExists('posts'); // Xóa bảng posts
    }
}
