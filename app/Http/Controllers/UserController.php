<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
   
    // Dang nhap nguoi dung
    public function login(Request $request){
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password, [])){
           return response()->json(
            ['message' => 'Email or password is invalid'], 401); 
        }

        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json(
            [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
       }
    // Tạo người dùng mới
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'string|in:user,admin', // Kiểm tra giá trị role
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Mã hóa password
        $user->role = $request->role ?? 'user'; // Gán vai trò mặc định là 'user'
        $user->save();

        return response()->json(['user' => $user], 201);
    }

         // Lấy danh sách tất cả người dùng
         public function user(Request $request){
            return $request->user();
        }

        public function index(){
            return User::all();
        }
        public function logout(){
            
            // xoa token
            // auth()->user()->currentAccessToken()->delete();
            DB::table('personal_access_tokens')->where('tokenable_id', auth()->id())->delete();

            return response()->json(['message' => 'Logged out']);

        //     //
        //     $request->user()->currentAccessToken()->delete();

        //     //
        //     $user->tokens()->where('id', $tokenId)->delete();
        // }
    }
    
    
    // Lấy thông tin người dùng theo ID
    // public function show($id)
    // {
    //     return User::findOrFail($id);
    // }

    // // Cập nhật thông tin người dùng
    // public function update(Request $request, $id)
    // {
    //     // Xác thực dữ liệu
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users,email,' . $id,
    //         'password' => 'nullable|string|min:8',
    //         'role' => 'nullable|string|in:user,admin',
    //     ]);
    
    //     // Tìm người dùng theo ID
    //     $user = User::findOrFail($id);
    
    //     // Cập nhật thông tin người dùng
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    
    //     if ($request->filled('password')) {
    //         $user->password = Hash::make($request->password); // Mã hóa password nếu có
    //     }
    
    //     $user->role = $request->role ?? $user->role; // Giữ nguyên vai trò nếu không có thay đổi
    //     $user->save();
    
    //     // Trả về phản hồi 200 với thông tin người dùng đã cập nhật
    //     return response()->json(['user' => $user], 201);
    // }
    


    // // Xóa người dùng
    // public function destroy($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->delete();

    //     return response()->json(null, 204);
    // }
}