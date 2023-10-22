
function MemeDashboardLogo(){

    return(
        <img src="/assets/images/white_writing.png"
        alt="Logo"
                style={{
                    maxWidth: "500px", // Set a maximum width for responsiveness
                    width: "150px", // Make the width 100% to adapt to the container's width
                    height: "100px", // Let the height adjust proportionally
                    objectFit: "cover",
                    borderRadius: "15px", // Add border radius for rounded edges
                    // border: "2px solid orange", // Add a light blue border outline
                }}

        />
    );
}

export default MemeDashboardLogo;