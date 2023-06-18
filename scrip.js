///for register validation of inputs...........................

function validateForm() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    
    if (name === "" || email === "" || password === "") {
      alert("Please fill in all fields");
      return false;
    }
    
    // You can add more specific validation rules for each field here if needed
    
    return true;
  }


//login validation for the form
  function validateForm() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    
    // Regular expression pattern to validate email format
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (!emailPattern.test(email)) {
      alert("Please enter a valid email address");
      return false;
    }
    
    if (password.length < 8) {
      alert("Password must be at least 8 characters long");
      return false;
    }
    
    return true;
  }
  
  