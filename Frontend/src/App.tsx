import React from 'react';
import { RouterProvider } from 'react-router-dom';
import { PublicRoute } from './routes/publicRoute';
import './index.css'

const App: React.FC = () => {
  return (
    <RouterProvider router={PublicRoute} />
  );
};

export default App;
