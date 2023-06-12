document.getElementById('feedback-form').addEventListener('submit', function(event) {
    event.preventDefault();
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var userType = document.querySelector('input[name="user-type"]:checked');
    var category = document.getElementById('category').value;
    var message = document.getElementById('message').value;
  
    if (!name || !email || !userType || !category || !message) {
      alert('Please fill in all the required fields.');
      return;
    }
  
    // Form is successfully submitted
    alert('Feedback submitted successfully!');
    // Reset the form
    document.getElementById('feedback-form').reset();
  });
  