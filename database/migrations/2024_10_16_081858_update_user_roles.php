<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class UpdateUserRoles extends Migration
{
    public function up()
    {
        // Cập nhật vai trò cho tất cả người dùng
        User::where('role', 0)->update(['role' => 'user']);
        
        // Cập nhật vai trò cho người dùng có ID cụ thể nếu cần
        User::where('id', 1)->update(['role' => 'admin']);
    }

    public function down()
    {
        // Nếu cần, bạn có thể quay lại vai trò cũ
        User::where('role', 'user')->update(['role' => 0]);
        User::where('role', 'admin')->update(['role' => 0]);
    }
}
