import React from "react";
import "./main.scss";
import { Card } from "antd";
import PostForm from "../../components/postForm/postForm";

const MainComponent: React.FC = () => {
    return (
        <div style={{ padding: '20px' }}>
          {/* Post Form */}
          <div className="post-form">
            <PostForm />
          </div>
    
          {/* Feed */}
          <div className="feed">
            <Card style={{ margin: '10px 0' }}>
              This is a tweet example.
            </Card>
            <Card style={{ margin: '10px 0' }}>
              Another tweet example.
            </Card>
            <Card style={{ margin: '10px 0' }}>
              Another tweet example.
            </Card>
            <Card  style={{ margin: '10px 0' }}>
              Another tweet example.
            </Card>
            <Card style={{ margin: '10px 0' }}>
              Another tweet example.
            </Card>
            <Card style={{ margin: '10px 0' }}>
              Another tweet example.
            </Card>
            <Card style={{ margin: '10px 0' }}>
              Another tweet example.
            </Card>  
          </div>
        </div>
      );
}
export default MainComponent;