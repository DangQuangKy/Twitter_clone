import { createBrowserRouter } from "react-router-dom";
import DefaultLayout from "../layouts/defaultLayout/defaultLayout";
import MainComponent from "../layouts/main/main";
import Login from "../pages/logout/login";
import Register from "../pages/register/register";

export const PublicRoute = createBrowserRouter([
    {
        path: "/",
        element: <DefaultLayout />,
        children: [
            {
                path: "",
                element: <MainComponent />
            }
            
        ]
    },
    {
        path:"/login",
        element: <Login />
    }, 
    {
        path: "/register",
        element: <Register />
    }
])
