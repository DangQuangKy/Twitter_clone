<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

    // Phương thức hiển thị form đăng nhập
    public function login()
    {
        return view('auth.login'); // Trả về view chứa form đăng nhập
    }

    // Phương thức xử lý đăng nhập
    public function loginSubmit(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt($request->only('email', 'password'))) {
            // Đăng nhập thành công, chuyển hướng đến trang dashboard
            return redirect()->intended('/dashboard');
        }

        // Nếu thông tin đăng nhập không chính xác, trả về thông báo lỗi
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

    // Phương thức đăng xuất
    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất người dùng
        return redirect('/login'); // Chuyển hướng về trang đăng nhập
    }
    public function register()
    {
        return view('auth.register'); // Trả về view chứa form đăng ký
    }

    // Phương thức xử lý đăng ký
    public function registerSubmit(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Tạo người dùng mới
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>$request->password, // Mã hóa mật khẩu
        ]);

         // Thử đăng nhập bằng email và mật khẩu
    if (Auth::attempt($request->only('email', 'password'))) {
        // Đăng nhập thành công
        return redirect()->intended('/dashboard');
    } else {
        // Đăng nhập thất bại, quay lại trang login với lỗi
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.'
        ]);
    }

    }
}
