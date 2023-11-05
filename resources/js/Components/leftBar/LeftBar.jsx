import "./leftBar.scss";
import Friends from "../../../../public/assets/images/1.png";
import Groups from "../../../../public/assets/images/2.png";
import Market from "../../../../public/assets/images/3.png";
import Watch from "../../../../public/assets/images/4.png";
import Memories from "../../../../public/assets/images/5.png";
import Events from "../../../../public/assets/images/6.png";
import Gaming from "../../../../public/assets/images/7.png";
import Gallery from "../../../../public/assets/images/8.png";
import Videos from "../../../../public/assets/images/9.png";
import Messages from "../../../../public/assets/images/10.png";
import Tutorials from "../../../../public/assets/images/11.png";
import Courses from "../../../../public/assets/images/12.png";
import Fund from "../../../../public/assets/images/13.png";
import { AuthContext } from "../../context/authContext";
import { useContext } from "react";

const LeftBar = () => {

  // const { currentUser } = useContext(AuthContext);

  return (
    <div className="leftBar">
      <div className="container">
        <div className="menu">
          <div className="user">
            <img
              src=""
              alt=""
            />
            <span></span>
          </div>
          <div className="item">
            <img src={Friends} alt="" />
            <span>Friends</span>
          </div>
          <div className="item">
            <img src={Groups} alt="" />
            <span>Groups</span>
          </div>
          <div className="item">
            <img src={Market} alt="" />
            <span>Marketplace</span>
          </div>
          <div className="item">
            <img src={Watch} alt="" />
            <span>Watch</span>
          </div>
          <div className="item">
            <img src={Memories} alt="" />
            <span>Memories</span>
          </div>
        </div>
        <hr />
        <div className="menu">
          <span>Your shortcuts</span>
          <div className="item">
            <img src={Events} alt="" />
            <span>Events</span>
          </div>
          <div className="item">
            <img src={Gaming} alt="" />
            <span>Gaming</span>
          </div>
          <div className="item">
            <img src={Gallery} alt="" />
            <span>Gallery</span>
          </div>
          <div className="item">
            <img src={Videos} alt="" />
            <span>Videos</span>
          </div>
          <div className="item">
            <img src={Messages} alt="" />
            <span>Messages</span>
          </div>
        </div>
        <hr />
        <div className="menu">
          <span>Others</span>
          <div className="item">
            <img src={Fund} alt="" />
            <span>Fundraiser</span>
          </div>
          <div className="item">
            <img src={Tutorials} alt="" />
            <span>Tutorials</span>
          </div>
          <div className="item">
            <img src={Courses} alt="" />
            <span>Courses</span>
          </div>
        </div>
      </div>
    </div>
  );
};

export default LeftBar;
