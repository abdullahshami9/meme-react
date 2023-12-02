// Reaction.jsx
import React from "react";

const Reaction = ({ emoji, count }) => {
  return (
    <div className="reaction">
      <span>{emoji}</span>
      {liked ? <FavoriteOutlinedIcon /> : <FavoriteBorderOutlinedIcon />}
      <span>{emoji}</span>
      <span className="count">{count}</span>
    </div>
  );
};

export default Reaction;
