import "../../../css/search.css";
//import "@/Components/searchs/searchs.scss";

import { useState } from "react";

const search = ({ search }) => {
  //const [SearchOpen, SearchOpen] = useState(false);

  //TEMPORARY
  const addHommyButtton = false;

  return (
    <div className="Search">
      <div className="container">
        <div className="user">
          <div className="userInfo">
            <img src={search.profilePic} alt="" />
            <div className="details">
              <Link
                to={`/profile/${search.userId}`}
                style={{ textDecoration: "none", color: "inherit" }}
              >
                <span className="name">{search['profile_id_fk']}</span>
              </Link>
              <span className="date">{search['updated_at']}</span>
            </div>
          </div>
          <MoreHorizIcon />
        </div>
        
        {SearchClose && <Comments />}
      </div>
    </div>
  );
};

export default search;
