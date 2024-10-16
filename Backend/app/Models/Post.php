<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    use HasFactory;
    protected $fillable = ['title', 'content', 'image']; // Các thuộc tính có thể được gán hàng loạt
}
