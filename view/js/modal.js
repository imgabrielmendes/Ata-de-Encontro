// Get the modal
var modal = document.getElementById("myModal");

// Function to open the modal
function openModal() {
  modal.style.display = "block";
  setTimeout(function() {
    modal.style.opacity = "1"; // Set opacity to fully visible
  }, 10); // Delay to allow CSS transition to take effect
}

// Function to close the modal
function closeModal() {
  modal.style.opacity = "0"; // Set opacity to fully transparent
  setTimeout(function() {
    modal.style.display = "none";
  }, 300); // Same duration as CSS transition
}