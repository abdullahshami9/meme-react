import "./navbar.scss";
import HomeOutlinedIcon from "@mui/icons-material/HomeOutlined";
import DarkModeOutlinedIcon from "@mui/icons-material/DarkModeOutlined";
import WbSunnyOutlinedIcon from "@mui/icons-material/WbSunnyOutlined";
import GridViewOutlinedIcon from "@mui/icons-material/GridViewOutlined";
import NotificationsOutlinedIcon from "@mui/icons-material/NotificationsOutlined";
import EmailOutlinedIcon from "@mui/icons-material/EmailOutlined";
import PersonOutlinedIcon from "@mui/icons-material/PersonOutlined";
import SearchOutlinedIcon from "@mui/icons-material/SearchOutlined";
import { Link } from "react-router-dom";
import { useContext, useState } from "react";
import { DarkModeContext } from "../../context/darkModeContext";
import { AuthContext } from "../../context/authContext";
import MemeDashboardLogo from "../MemeDashboardLogo";
import axios from 'axios'
import ApiCallComponent from "../searchcomponents/searches";

const Navbar = ({ user }) => {
  const [searchValue, setSearchValue] = useState('');
  const [result,setResult]= useState(null);
  const handleSearchChange = (e) => {
    e.preventDefault();
    setSearchValue(e.target.value);

    // const apiUrl = 'http://127.0.0.1:8000/api/user/friend/search';
    // const requestData = {
    //   "search": searchValue,
    // };

    // console.log(searchValue);
    // // Make a POST request to the API using Axios.
    // axios.post(apiUrl, requestData)
    //   .then(response => {
    //     // Handle the successful response here.
    //     console.log(response.data);
    //   })
    //   .catch(error => {
    //     // Handle errors if the request fails.
    //     console.error('Error:', error);
    //   });
  };
  // const { toggle, darkMode } = useContext(DarkModeContext);
  // const { currentUser } = useContext(AuthContext);

  return (
    <div className="navbar">
      <div className="left">
        <Link to="/" style={{ textDecoration: "none" }}>
          <MemeDashboardLogo />
        </Link>
        <HomeOutlinedIcon />
        {/* {darkMode ? (
          <WbSunnyOutlinedIcon onClick={toggle} />
        ) : (
          <DarkModeOutlinedIcon onClick={toggle} />
        )} */}
        <GridViewOutlinedIcon />
        <div className="search">
          <SearchOutlinedIcon />
          <input
            type="text"
            placeholder="Search..."
            value={searchValue}
            onChange={handleSearchChange}
          />
          <ApiCallComponent searchValue={searchValue}/>
        </div>
      </div>
      <div className="right">
        <PersonOutlinedIcon />
        <EmailOutlinedIcon />
        <NotificationsOutlinedIcon />
        <div className="user">
          <Link

            to={route('profile.user')}
          >
            <img
              // src={currentUser.profilePic}
              alt=""
            />
            <span>{user.name}</span>
          </Link>

          {/* <span>{currentUser.name}</span> */}
        </div>
      </div>
    </div>
  );
};

export default Navbar;
