<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Cho phép các trường này có thể được gán hàng loạt
    protected $fillable = [
        'name',
        'email',
        'password',
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
