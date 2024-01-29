import Post from "@/Components/post/Post";
import "../../../css/posts.css";
import axios from "axios";
import { useEffect, useState } from "react";

const Posts = () => {

  const [post, setPosts] = useState([]); // Change state variable name to "posts" and initialize as an empty array

  useEffect(() => {
    async function fetchData() {
      // const response = await axios.post("http://localhost:8000/api/user/profile/all-post");
      if (response) {
        setPosts(response.data['$data']);
      } else {
        console.log('No Post to show');
      }
    }
    fetchData();
    // Make the Axios GET request to fetch posts
    // .then((response) => {
    //   setPosts(response.data);
    //   console.log(response.data); // Update the state with the fetched data
    // })
    // .catch((error) => {
    //   console.error("Error fetching posts:", error);
    // });
  }, []);

  //TEMPORARY 
  // const posts = [
  //   {
  //     id: 1,
  //     name: "John Doe",
  //     userId: 1,
  //     profilePic:
  //       "https://images.pexels.com/photos/1036623/pexels-photo-1036623.jpeg?auto=compress&cs=tinysrgb&w=1600",
  //     desc: "Lorem ipsum dolor sit amet consectetur adipisicing elit",
  //     img: "https://images.pexels.com/photos/4881619/pexels-photo-4881619.jpeg?auto=compress&cs=tinysrgb&w=1600",
  //   },
  //   {
  //     id: 2,
  //     name: "Jane Doe",
  //     userId: 2,
  //     profilePic:
  //       "https://images.pexels.com/photos/1036623/pexels-photo-1036623.jpeg?auto=compress&cs=tinysrgb&w=1600",
  //     desc: "Tenetur iste voluptates dolorem rem commodi voluptate pariatur, voluptatum, laboriosam consequatur enim nostrum cumque! Maiores a nam non adipisci minima modi tempore.",
  //   },
  // ];
  // console.log(post);
  return <div className="posts">

    {
      post.length == 0 && <div>Loading posts...</div>
    }
    {post.length > 0 && post.map(

      (p, index) => (
        <Post post={p} key={index} />
      ))}
  </div>;
};

export default Posts;
