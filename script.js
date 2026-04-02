// 1. Event Handling: Alert when page loads
window.onload = function() {
    console.log("Portfolio Website Loaded Successfully!");
};

// 2. Form Validation & DOM Manipulation
document.querySelector('form').addEventListener('submit', function(event) {
    // Prevent form from submitting/refreshing the page
    event.preventDefault();

    // Get input values using querySelector
    const name = document.querySelector('input[name="name"]').value;
    const email = document.querySelector('input[name="email"]').value;
    const message = document.querySelector('textarea[name="message"]').value;

    // 3. Simple Validation Logic
    if (name === "" || email === "" || message === "") {
        alert("Please fill all the fields before submitting!");
    } else if (!email.includes("@")) {
        alert("Please enter a valid email address!");
    } else {
        // Success Message
        alert("Thank you, " + name + "! Your message has been sent successfully.");
        
        // Clear the form after success
        this.reset();
    }
});