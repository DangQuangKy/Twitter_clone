import React, { useState } from "react";
import "./postForm.scss";
import { Post } from "../../types/post.type";

const PostForm = ({
  setPosts,
}: {
  setPosts: React.Dispatch<React.SetStateAction<Post[]>>;
}) => {
  const [content, setContent] = useState("");
  const [image, setImage] = useState<File | null>(null);
  const [message, setMessage] = useState("");

  const handleImageChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.files) {
      setImage(e.target.files[0]);
    }
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();

    const formData = new FormData();
    formData.append("content", content);
    if (image) {
      formData.append("image", image);
    }

    try {
      const response = await fetch("http://127.0.0.1:8000/api/posts", {
        method: "POST",
        body: formData,
      });
      const data = await response.json();
      if (response.ok) {
        setMessage(data.message);
        setContent("");
        setImage(null);
        setPosts((prevPosts) => [ data.post, ...prevPosts]);
      } else {
        setMessage(data.message);
      }
    } catch (error) {
      console.error(error);
      setMessage("error!");
    }
  };

  return (
    <div className="create-post-container">
      <h1 className="form-title">Tạo Bài Viết Mới</h1>
      {message && <div className="message">{message}</div>}
      <form onSubmit={handleSubmit} className="post-form">
        <div className="form-group">
          <label htmlFor="content">Nội dung:</label>
          <textarea
            id="content"
            value={content}
            onChange={(e) => setContent(e.target.value)}
            required
          ></textarea>
        </div>
        <div className="form-group">
          <label htmlFor="image">Hình ảnh:</label>
          <input type="file"
           id="image"
            onChange={handleImageChange} />
        </div>
        <button type="submit" className="submit-btn">
          Tạo Bài Viết
        </button>
      </form>
    </div>
  );
};

export default PostForm;
