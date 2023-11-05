import React, { useState } from 'react';

const SearchBar = () => {
  const [query, setQuery] = useState('');
  const [searchResults, setSearchResults] = useState([]);

  const handleSearch = () => {
    // Make an Axios request to your Laravel API
    axios
      .get(`/api/friends/search?query=${query}`)
      .then((response) => {
        // Assuming the API returns search results as an array
        setSearchResults(response.data);
      })
      .catch((error) => {
        console.error('An error occurred:', error);
      });
  };

  return (
    <div className="search-bar" style={{ marginTop: 15 }}>
      <div className="search-input">
        <input
          type="text"
          // placeholder="S<span style='color: red;'>e</span>a<span style='color: blue;'>r</span>c<span style='color: green;'>h</span>..."j
          placeholder='Search...'
          value={query}
          onChange={(e) => setQuery(e.target.value)}
          style={{
            backgroundColor: 'transparent',
            border: 'none',
            width: '90%',
            color: 'black',
          }}
        />
        <button onClick={handleSearch}>
          <i className="fas fa-search"></i> {/* Add your search icon class here */}
        </button>
      </div>
    </div>
  );
};

export default SearchBar;
