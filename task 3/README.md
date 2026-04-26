# Task 3: User Management System (CRUD)

This project is a secure User Management System developed using PHP and MySQL as part of the ApexPlanet Internship. It provides a complete interface for managing user data with a focus on security and clean UI.

## 🚀 Features
- **Secure Authentication:** Robust Registration and Login system with session-based access.
- **Full CRUD Functionality:**
  - **Create:** User registration including profile picture upload.
  - **Read:** All registered users are displayed in a clean, responsive table.
  - **Update:** Users can easily modify their username and update their profile photo.
  - **Delete:** Quick record removal with a JavaScript "Are you sure?" confirmation.
  - **Logical Security:** Prevented logged-in users from deleting their own active accounts.

## 🛡️ Security Implementation
- **SQL Injection Prevention:** 100% usage of Prepared Statements (`mysqli_prepare`) for all database interactions.
- **Data Encryption:** Passwords are never stored in plain text; they are secured using `password_hash()`.
- **Validation:** Implemented strict server-side validation to ensure clean and safe data entry.

## 📂 Project Files
- `config.php`: Database connectivity.
- `register.php`: User signup interface.
- `login.php`: Secure access portal.
- `dashboard.php`: User's personalized landing page.
- `users_list.php`: Management table for all users.
- `edit_profile.php`: Profile update interface.
- `uploads/`: Dedicated directory for profile images.

## 🛠️ Setup
1. Export your database to a `.sql` file and place it in this folder.
2. Configure your MySQL credentials in `config.php`.
3. Run through XAMPP: `localhost/my_internship/task 3/`