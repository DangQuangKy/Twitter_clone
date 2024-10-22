<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasFactory;

    // Cho phép các trường này có thể được gán hàng loạt
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
    ];

    // Các trường bị ẩn khi trả về dưới dạng JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Các trường nên được định dạng theo kiểu nhất định
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
