import Stories from "../../components/stories/Stories"
import Posts from "../../components/posts/Posts"
import Share from "../../components/share/Share"
import "@/Pages/home/home.scss"
import {
  createBrowserRouter,
  RouterProvider,
  Route,
  Outlet,
  Navigate,
} from "react-router-dom";

const Home = () => {
  return (
    <div className="home">
      <div style={{ flex: 6 }}>
        <Outlet />
      </div>
    </div>
  )
}

export default Home