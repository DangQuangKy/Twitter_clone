import { PictureOutlined } from "@ant-design/icons";
import { Button, Form, Input, Upload } from "antd";

const PostForm: React.FC = () => {
  return (
    <Form layout="vertical" style={{ maxWidth: 600, margin: "auto" }}>
      <Form.Item
        label="What's happening?"
        name="content"
        rules={[{ required: true, message: "Please enter your post!" }]}
      >
        <Input.TextArea
          rows={4}
          maxLength={280}
          placeholder="Share your thoughts..."
        />
      </Form.Item>
      <Form.Item label="Upload Images">
        <div style={{ display: "flex", justifyContent: "space-between" }}>
          <Upload>
            <Button icon={<PictureOutlined />} />
          </Upload>
          <Button type="primary" htmlType="submit">
            Post
          </Button>
        </div>
      </Form.Item>
    </Form>
  );
};

export default PostForm;
