import {
  FacebookOutlined,
  GooglePlusOutlined,
  KeyOutlined,
  LinkedinOutlined,
  TwitterOutlined,
  UserOutlined,
} from "@ant-design/icons";
import "./login.scss";
import { Link, useNavigate } from "react-router-dom";
import React, { useState } from "react";

const Login: React.FC = () => {
  const [email, setEmail] = useState<string>("");
  const [password, setPassword] = useState<string>("");
  const [error, setError] = useState<string | null>(null);
  const [loading, setLoading] = useState<boolean>(false);
  const navigate = useNavigate();

  const handleLogin = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    setError(null);

    try {
      const response = await fetch("http://127.0.0.1:8000/api/login", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          email,
          password,
        }),
      });

      const data = await response.json();
      console.log(data);

      if (response.ok) {
        // Đăng nhập thành công
        localStorage.setItem("token", data.access_token); 
        navigate("/"); // Chuyển đến trang chính
      } else {
        // Xử lý lỗi từ server
        setError(data.message || "Đăng nhập thất bại");
      }
    // eslint-disable-next-line @typescript-eslint/no-unused-vars
    } catch (err) {
      // Xử lý lỗi kết nối
      setError("Không kết nối được với server");
    } finally {
      setLoading(false); // Dừng hiển thị loading khi hoàn thành
    }
  };

  return (
    <main className="logout">
      <form className="flex col-2 row" id="form" onSubmit={handleLogin}>
        <div className="left col">
          <div className="col-spacer">
            <div className="form-header">
              &nbsp;<UserOutlined />
              <span>Đăng nhập</span>
            </div>
          </div>
          <div className="input-wrap">
            <div className="input-icon">
              <div className="icon">
                &nbsp;<UserOutlined />
              </div>
              <input
                type="email"
                value={email}
                placeholder="Username or Email"
                onChange={(e) => setEmail(e.target.value)}
                required
              />
            </div>
          </div>
          <div className="input-wrap">
            <div className="input-icon">
              <div className="icon">
                &nbsp;<KeyOutlined />
              </div>
              <input
                type="password"
                value={password}
                placeholder="Password"
                onChange={(e) => setPassword(e.target.value)}
                required
              />
            </div>
            {error && <p style={{ color: "red" }}>{error}</p>}
            <div className="input-desc-title">
              <a className="input-desc" href="#">
                Quên mật khẩu?
              </a>
              <Link className="input-desc" to="/register">
                Chưa có tài khoản?
              </Link>
            </div>
          </div>
          <div className="flex space mt-5">
            <div className="cb-wrap">
              <input
                className="glow"
                id="remember"
                type="checkbox"
                name="remember"
              />
              <label>Nhớ tài khoản</label>
            </div>
            <button className="primary big button" type="submit" disabled={loading}>
              {loading ? "Đang đăng nhập..." : "Đăng nhập"}
            </button>
          </div>
        </div>
        <div className="right col flex column">
          <div className="col-spacer"></div>
          <button className="twitter social button">
            <TwitterOutlined />
            &nbsp;Sign in with Twitter
          </button>
          <button className="facebook social button">
            <FacebookOutlined />
            &nbsp;Sign in with Facebook
          </button>
          <button className="googleplus social button">
            <GooglePlusOutlined />
            &nbsp;Sign in with Google+
          </button>
          <button className="linkedin social button">
            <LinkedinOutlined />
            &nbsp;Sign in with Linkedin
          </button>
        </div>
      </form>
    </main>
  );
};

export default Login;
