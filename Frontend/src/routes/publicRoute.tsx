import { createBrowserRouter } from "react-router-dom";
import DefaultLayout from "../layouts/defaultLayout/defaultLayout";
import HomePage from "../pages/home/homePage";

export const PublicRoute = createBrowserRouter([
    {
        path: "/",
        element: <DefaultLayout />,
        children: [
            {
                path: "/",
                element: <HomePage />
            }
        ]
    }
])
