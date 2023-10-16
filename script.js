// Get a reference to the alert element
const alertElement = document.getElementById('myAlert');

// Function to hide the alert with a fade-out effect
function hideAlertWithFade() {
  alertElement.classList.remove('show');
  alertElement.classList.add('fade');

  // After the fade-out animation is complete, you can remove or hide the element
  setTimeout(() => {
    alertElement.style.display = 'none'; // You can also use .remove() to remove it from the DOM
  }, 2000); // Adjust the timing based on your transition duration
}

// Set a timer to hide the alert with a fade-out effect after 30 seconds (30,000 milliseconds)
setTimeout(hideAlertWithFade, 2000);


// check conditon and show content

let condition = true



// Get references to the content sections
const conditionalContent = document.getElementById('conditionalContent');
const alternateContent = document.getElementById('alternateContent');

// Get references to the elements
//   const successAlert = document.getElementById('successAlert');
//   const errorAlert = document.getElementById('errorAlert');
const myForm = document.getElementById('myForm');


if (condition) {
  // If the condition is ture, show the second alert and hide the form
  conditionalContent.style.display = 'block';
  alternateContent.style.display = 'none';
  myForm.style.display = 'none'; // Ensure the form is hidden
} else {


  // If the condition is false, show the first alert and the form
  conditionalContent.style.display = 'none';
  alternateContent.style.display = 'block'; // Ensure the alternate content is hidden
}