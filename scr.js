//login based of chooice

// Assuming you have an HTML login form with input fields for username and password
/*
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const loginButton = document.getElementById('loginButton');

// Add an event listener to the login button
loginButton.addEventListener('click', function() {
  event.preventDefault();
  const username = usernameInput.value;
  const password = passwordInput.value;

  // Perform authentication logic here (e.g., check credentials against a database)

  // Assuming you have a variable 'role' indicating the user's role ('student' or 'faculty')
  // Replace this with your own authentication logic
  const role = authenticateUser(username, password);

  // Redirect the user based on their role
  if (role === 'Student') {
    // Redirect to student dashboard
    window.location.href = 'student/stu-dash.html';
  } else if (role === 'Faculty') {
    // Redirect to faculty dashboard
    window.location.href = 'fac.html';
  } else if (role === 'Admin') {
    // Redirect to faculty dashboard
    window.location.href = 'admin/admin.html';
  } else {
    // Invalid credentials or role not recognized
    alert('Invalid credentials. Please try again.');
  }
});

function authenticateUser(username, password) {
  // Your authentication logic here
  // This function should return the user's role ('student' or 'faculty')
  // You can implement your own authentication mechanism (e.g., check against a database)

  // For demonstration purposes, assuming hardcoded credentials for simplicity
  if (username === 'student123' && password === 'password123') {
    return 'Student';
  } else if (username === 'faculty456' && password === 'password456') {
    return 'Faculty';
  } else if (username === 'admin456' && password === 'password456') {
    return 'Admin';
  } else {
    return null; // Invalid credentials or role not recognized
  }
}

*/

