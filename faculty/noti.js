document.getElementById("requestForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission
  
    // Get form data
    var date = document.getElementById("date").value;
    var timeslot = document.getElementById("timeslot").value;
    var room = document.getElementById("room").value;
    var reason = document.getElementById("reason").value;
  
    // Send notification
    sendNotification("Request submitted successfully");
  
    // Reset form
    document.getElementById("requestForm").reset();
});
  
function sendNotification(message) {
    var notificationDiv = document.getElementById("notification");
    notificationDiv.textContent = message;
    notificationDiv.classList.add("show");
  
    // Hide notification after 5 seconds
    setTimeout(function() {
      notificationDiv.classList.remove("show");
    }, 5000);
}

function logout() {
    window.location.href = "../login.html";
    };