import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
// import '../../../style.scss';
import {
  createBrowserRouter,
  RouterProvider,
  Route,
  Outlet,
  Navigate,
} from "react-router-dom";
import '@/Components/pages/home/home.scss';
import Share from '@/Components/share/Share';
import Posts from '@/Components/posts/Posts';
import LeftBar from '@/Components/leftBar/LeftBar';
import RightBar from '@/Components/rightBar/RightBar';
import Navbar from '@/Components/navbar/Navbar';
import Stories from '@/Components/stories/Stories';

export default function Dashboard({ auth }) {
  return (
    <AuthenticatedLayout
      user={auth.user}
      header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Posts</h2>}
    >
      <Head title="Dashboard" />
      <div style={{ display: "flex", color: 'white' }}>
        <LeftBar />
        
        
        <div style={{ flex: 6 }}>
        <Outlet />
          <div className='home'>
            <Stories/>
            <Share />
            <Posts />
          </div>
        </div>
        <RightBar/>

      </div>

    </AuthenticatedLayout>


  );
}
