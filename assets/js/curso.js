// Function to open the video modal
function openVideoModal() {
    var modal = document.getElementById("videoModal");
    var video = document.getElementById("courseVideo");

    // Show the modal and play the video
    modal.style.display = "block";
    video.play();

    // Prevent closing the modal until the video ends
    video.onended = function() {
        modal.style.display = "none";
    };
}

// Close the modal when clicking outside of the video
window.onclick = function(event) {
    var modal = document.getElementById("videoModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
