import { Layout } from "antd";
import React from "react";
import "./header.scss";
import { Link } from "react-router-dom";

const { Header } = Layout;
const HeaderComponent: React.FC = () => {
  return (
    <Header className="header">
      <div className="header-container">
        <div className="header-container-left link">
          <Link to="/">For you</Link>
        </div>
        <div className="header-container-right link">
          <Link to="/">Following</Link>
        </div>
      </div>
    </Header>
  );
};
export default HeaderComponent;
