import React from "react";
import "./main.scss";
import { Card } from "antd";
import PostForm from "../../components/postForm/postForm";
import { useFetch } from "../../hooks/useFetch";
import { Post } from "../../types/post.type";
import UserComponent from "../../components/userComponent/userComponent";

const MainComponent: React.FC = () => {
  const {
    data: posts,
    error,
    setData: setPosts,
  } = useFetch<Post>("http://127.0.0.1:8000/api/posts");
  if (error) {
    return <div>{error}</div>;
  }

  return (
    <div style={{ padding: "20px" }}>
      {/* Post Form */}
      <div className="post-form">
        <PostForm setPosts={setPosts} />
      </div>
      <div>
        <UserComponent /> 
      </div>

      {/* Feed */}
      <Card style={{ margin: "10px 0" }}>
        <div className="feed">
          {posts?.map((post) => (
            <div key={post.id} className="post-item">
              <div className="post-content">
                <h2>{post.content}</h2>
              </div>
              <div className="post-image">
                <img
                  src={
                    post.image
                      ? `http://localhost:8000/storage/${post.image}`
                      : "https://via.placeholder.com/150"
                  }
                  alt={post.image}
                />
              </div>
            </div>
          ))}
        </div>
      </Card>
    </div>
  );
};

export default MainComponent;
