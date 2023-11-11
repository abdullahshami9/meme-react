import { Button } from "@mui/material";
import "../../../css/post.scss";
import { Link } from "react-router-dom";
//import "@/Components/searchs/searchs.scss";

import { useState } from "react";

const UserSearch = ({ search }) => {
  //const [SearchOpen, SearchOpen] = useState(false);

  //TEMPORARY
  const addHommyButtton = false;

  return (
    <div className="post">
      <div className="container" 
      // style={{background:"gray"}}
      >
        <div className="user">
          <div className="userInfo">
            <img src={'search.profilePic'} alt="" />
            <div className="details">
              <Link
                to={`/profile/${search['user_id_fk']}`}
                style={{ textDecoration: "none", color: "inherit" }}
              >
                <span className="name">{search['username']}</span>
              </Link>
              <span className="date">{search['city_id_fk']}</span>
            </div>
          </div>
          {/* <Button title="Add Hommy :)"/> */}
          <button>Add Hommy</button>
        </div>
        
      </div>
    </div>
  );
};

export default UserSearch;
