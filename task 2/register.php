<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Task 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light" style="min-height: 100vh; display: flex; flex-direction: column;">

    <?php include 'header.php'; ?>

    <div class="container flex-grow-1 d-flex align-items-center justify-content-center py-5">
        <div class="row justify-content-center w-100">
            <div class="col-md-5">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4 fw-bold text-success">Create Account</h3>
                        
                        <form id="registerForm">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="regName" placeholder="Full Name" required>
                                <label for="regName">Full Name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="regEmail" placeholder="name@example.com" required>
                                <label for="regEmail">Email address</label>
                                <div class="invalid-feedback">This email is already registered.</div>
                            </div>
                            
                            <div class="input-group mb-3">
                                <div class="form-floating flex-grow-1">
                                    <input type="password" class="form-control" id="regPassword" placeholder="Password" required>
                                    <label for="regPassword">Password</label>
                                </div>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">Show</button>
                            </div>

                            <div class="input-group mb-3">
                                <div class="form-floating flex-grow-1">
                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
                                    <label for="confirmPassword">Confirm Password</label>
                                </div>
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirm">Show</button>
                            </div>

                            <div class="mb-3 text-center">
                                <small class="text-muted">By clicking Register, you agree to our 
                                    <a href="#" class="text-decoration-none fw-bold text-success" data-bs-toggle="modal" data-bs-target="#termsModal">Terms & Conditions</a>
                                </small>
                            </div>

                            <button class="btn btn-success w-100 py-2 fw-bold" type="submit">REGISTER</button>
                        </form>

                        <hr class="my-4">
                        <p class="text-center small">Already have an account? <a href="login.php" class="text-decoration-none fw-bold text-primary">Login Here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title fw-bold" id="termsModalLabel">Terms and Conditions</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <p>Welcome to our platform. By registering, you agree to follow our community guidelines and privacy policy.</p>
            <ul>
                <li>Provide accurate information during registration.</li>
                <li>Maintain the security of your account credentials.</li>
                <li>Respect the privacy and rights of other users.</li>
            </ul>
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // 1. Password Visibility Logic
        function setupToggle(buttonId, inputId) {
            const toggleBtn = document.getElementById(buttonId);
            const passwordInput = document.getElementById(inputId);

            toggleBtn.addEventListener('click', function () {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                this.textContent = isPassword ? 'Hide' : 'Show';
            });
        }
        setupToggle('togglePassword', 'regPassword');
        setupToggle('toggleConfirm', 'confirmPassword');

        // 2. Form Submission Logic
        const form = document.getElementById('registerForm');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const pass = document.getElementById('regPassword').value;
            const confirmPass = document.getElementById('confirmPassword').value;

            if (pass !== confirmPass) {
                alert("Error: Passwords do not match.");
            } else {
                alert("Success: Registration completed. Redirecting...");
                window.location.href = "login.php";
            }
        });

        // 3. AJAX Logic: Fetch from PHP
        const emailField = document.getElementById('regEmail');
        emailField.addEventListener('blur', function() {
            const emailValue = this.value;
            if (emailValue !== "") {
                const formData = new FormData();
                formData.append('email', emailValue);

                fetch('check_email.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    if (data === "exists") {
                        alert("AJAX Alert: This email is already registered! (Dummy)");
                        emailField.classList.add('is-invalid');
                        emailField.value = ""; 
                    } else {
                        emailField.classList.remove('is-invalid');
                        emailField.classList.add('is-valid');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    </script>
</body>
</html>