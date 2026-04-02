// 1. Console message for loading (Commit #8 update)
console.log("Shitanshu's Portfolio Version 2.0 Active!");

// 2. Form Validation & Handling
document.querySelector('form').addEventListener('submit', function(event) {
    // Page refresh hone se rokta hai
    event.preventDefault();

    // Saare input values nikalna (Subject ke saath)
    const name = document.querySelector('input[name="name"]').value;
    const email = document.querySelector('input[name="email"]').value;
    const subject = document.querySelector('input[name="subject"]').value;
    const message = document.querySelector('textarea[name="message"]').value;

    // 3. Professional Validation Logic
    if (name === "" || email === "" || message === "") {
        alert("Oops! Please fill all the required fields (Name, Email, Message).");
    } else if (!email.includes("@")) {
        alert("Please enter a valid email address!");
    } else {
        // Success Message (isme Subject bhi dikhayega)
        alert("Success! Thank you, " + name + ". Your message regarding '" + subject + "' has been sent.");
        
        // Debugging ke liye data console mein dikhana
        console.log("Form Submitted Successfully:", { name, email, subject, message });

        // Form ko clear kar dena
        this.reset();
    }
});