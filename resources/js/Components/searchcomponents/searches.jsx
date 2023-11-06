import React, { useState, useEffect } from 'react';
import axios from 'axios';
import UserSearch from '@/Components/searchcomponents/UserSearch';
import '../../../css/post.css';



const ApiCallComponent = ({ searchValue }) =>  {
  const [responseData, setResponseData] = useState([]);

  useEffect(() => {
    // Define the API URL and the data you want to send in the request.
    if(searchValue){

      const apiUrl = 'http://127.0.0.1:8000/api/user/friend/search';
      const requestData = {
        search: searchValue,
      };

      console.log(searchValue);
      // Make a POST request to the API using Axios.
      axios.post(apiUrl, requestData)
        .then(response => {
          // Handle the successful response here.

          if(response.data["status"]==200){
            setResponseData(response.data['message']);
          }
          
        })
        .catch(error => {
          // Handle errors if the request fails.
          console.error('Error:', error);
        });
    }
  }, [searchValue]); // The empty dependency array ensures this runs once on component mount.------------------------------

  return (
    <div className = "post" style={{marginTop: '250px',marginLeft: '-60%',width: '80%', backgroundColor:'white'}}>
      {
        responseData.length==0 && <div></div>
      }
      {
        responseData.length>0 && responseData.map((searchResult,index)=>(
          <UserSearch search={searchResult} key={index}/>
        ))
      }
    </div>
    
  );
};

export default ApiCallComponent;
   