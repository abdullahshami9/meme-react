// Reactions.jsx
import React, { useEffect, useState } from "react";
import axios from "axios";
import Reaction from "./Reaction";

const Reactions = ({ postId }) => {
  const [reactions, setReactions] = useState([]);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchReactions = async () => {
      try {
        const response = await axios.get(`localhost:8000/api/user/profile/get-reaction?post_id=${postId}`);
        // const response = await axios.get(`http://localhost:8000/api/post/${postId}/reactions`);
        setReactions(response.data); // Assuming the API response contains an array of reactions
      } catch (error) {
        console.error("Error fetching reactions:", error);
        setError(error); // Set the error state
        // If the API fails, use dummy values for testing
        setReactions([
          { id: 1, emoji: "😊", count: 5 },
          { id: 2, emoji: "❤️", count: 10 },
          // Add more dummy values if needed
        ]);
      }
    };

    fetchReactions();
  }, [postId]);

  if (error) {
    // Handle the error, you can display an error message or do something else
    return <div>Error fetching reactions</div>;
  }

  return (
    <div className="reactions">
      {reactions.map((reaction) => (
        <Reaction key={reaction.id} emoji={reaction.emoji} count={reaction.count} />
      ))}
    </div>
  );
};

export default Reactions;
