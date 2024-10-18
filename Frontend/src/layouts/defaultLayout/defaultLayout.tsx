import { Layout } from "antd";
import SideBarComponent from "../sideBar/sideBar";
import HeaderComponent from "../header/header";
import TrendComponent from "../trend/trend";
import { Outlet } from "react-router-dom";

const DefaultLayout: React.FC = () => {
    return(
        <div style={{padding: 0, margin: 0, boxSizing: 'border-box'}}>
          <Layout style={{ minHeight: '100vh' }}>
        {/* Sidebar */}
        <SideBarComponent />
  
        {/* Main Content */}
        <Layout>
          <HeaderComponent />
          <div style={{ padding: '20px' }}>
              <Outlet />
          </div>
        </Layout>
  
        {/* Right Sidebar (Trends) */}
        <TrendComponent />
      </Layout>
        </div>
    )
}
export default DefaultLayout;