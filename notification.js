// Handle form submission
document.getElementById("registrationForm").addEventListener("submit", function(event) {
  event.preventDefault(); // Prevent form submission

  var username = document.getElementById("username").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;

  // Send notification
  sendNotification("Form Submitted");

  // Reset form
  document.getElementById("registrationForm").reset();
});

// Function to send notification
function sendNotification(message) {
  var notificationDiv = document.getElementById("notification");
  notificationDiv.textContent = message;
  notificationDiv.style.display = "block";

  // Hide notification after 5 seconds
  setTimeout(function() {
    notificationDiv.style.display = "none";
  }, 5000);
}
