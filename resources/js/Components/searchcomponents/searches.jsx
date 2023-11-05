import React, { useState, useEffect } from 'react';
import axios from 'axios';



const ApiCallComponent = ({ searchValue }) =>  {
  const [responseData, setResponseData] = useState(null);

  useEffect(() => {
    // Define the API URL and the data you want to send in the request.
    const apiUrl = '127.0.0.1:8000/api/user/friend/search';
    const requestData = {
      search: searchValue,
    };

    console.log(searchValue);
    // Make a POST request to the API using Axios.
    axios.post(apiUrl, requestData)
      .then(response => {
        // Handle the successful response here.
        setResponseData(response.data);
      })
      .catch(error => {
        // Handle errors if the request fails.
        console.error('Error:', error);
      });
  }, []); // The empty dependency array ensures this runs once on component mount.------------------------------

  return (
    <div>
      <h1>API Response Data:</h1>
      <pre>{JSON.stringify(responseData, null, 2)}</pre>
    </div>
  );
};

export default ApiCallComponent;
   