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
        return Post::all();
    }

    // them bai viet
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|url',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        // lay URL cua hinh anh
        $imageUrl = $request->image;

        // tai hinh anh tu URL
        $imageContent = file_get_contents($imageUrl);

        // tao ten file duy nhat cho hinh anh
        $imageName = 'images/' . Str::random(10) . '.jpg';  

        // luu hinh anh vao folder public/images
        Storage::disk('public')->put($imageName, $imageContent);

        // luu duong dan vao db
        $post->image = $imageName;
        $post->save();

        return response()->json([
            'message' => 'Bài viết đã được thêm.',
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
            'title' => 'required',
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
