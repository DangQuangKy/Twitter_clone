<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // lay danh sach bai viet
    public function index()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json($posts);
    }

    // them bai viet
   
    public function store(Request $request)
{
    // Validate dữ liệu nhận được
    $request->validate([
        'content' => 'required|string|max:255',
        'image' => 'required|file|mimes:jpg,jpeg,png|max:2048', // Chấp nhận file ảnh với kích thước tối đa 2MB
    ]);

    // Tạo bài viết mới
    $post = new Post();
    $post->content = $request->content;

    // Xử lý file ảnh nếu có
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        // Tạo tên file duy nhất
        $imageName = time() . '_' . $image->getClientOriginalName();
        // Lưu trữ file trong thư mục 'public/images'
        $image->storeAs('public/images', $imageName);
        // Lưu đường dẫn vào DB
        $post->image = 'images/' . $imageName;
    }

    // Lưu bài viết vào cơ sở dữ liệu
    $post->save();

    // Trả về phản hồi JSON sau khi lưu thành công
    return response()->json([
        'message' => 'Bài viết đã được thêm thành công.',
        'post' => $post,
    ], 201);
}


    // lay thong tin 1 bai viet 
    public function show($id)
    {
        // Lấy bài viết dựa trên ID
        $post = Post::find($id);
        
        // Kiểm tra xem bài viết có tồn tại không
        if (!$post) {
            return response()->json(['message' => 'Bài viết không tồn tại.'], 404);
        }

        // Lấy thông tin người dùng từ bài viết
        $user = $post->user;

        // Trả về thông tin bài viết cùng với thông tin người dùng
        return response()->json([
            'post' => $post,
            'user' => $user,
        ]);
    }

    // cap nhat bai viet
    public function update(Request $request,$id)
    {
        $request->validate([
            'content' => 'required',
        ]);
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return response()->json($post, 200);
    }

   // xoa bai viet
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(null, 204); // tra ve trang thai 204 sau khi xoa
    }
}
