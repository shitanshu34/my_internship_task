<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Task 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light" style="min-height: 100vh; display: flex; flex-direction: column;">

    <?php include 'header.php'; ?>

    <div class="container flex-grow-1 d-flex align-items-center justify-content-center py-5">
        <div class="row justify-content-center w-100">
            <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4 fw-bold text-primary">Sign In</h3>
                        
                        <form id="loginForm">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="loginEmail" placeholder="name@example.com" required>
                                <label for="loginEmail">Email address</label>
                            </div>
                            
                            <div class="input-group mb-2">
                                <div class="form-floating flex-grow-1">
                                    <input type="password" class="form-control" id="loginPassword" placeholder="Password" required>
                                    <label for="loginPassword">Password</label>
                                </div>
                                <button class="btn btn-outline-secondary" type="button" id="toggleLoginPassword">Show</button>
                            </div>

                            <div class="mb-3 text-end">
                                <a href="#" class="text-decoration-none small text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password?</a>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>

                            <button class="btn btn-primary w-100 py-2 fw-bold" type="submit">LOGIN</button>
                        </form>

                        <hr class="my-4">
                        <p class="text-center small">New here? <a href="register.php" class="text-decoration-none fw-bold text-success">Create an Account</a></p>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="index.php" class="text-muted small text-decoration-none">← Back to Home</a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title fw-bold" id="forgotPasswordLabel">Reset Password</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <p class="text-muted mb-4">Please enter your registered email address. We will send you a link to reset your password.</p>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="resetEmail" placeholder="name@example.com">
                <label for="resetEmail">Email address</label>
            </div>
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary px-4 fw-bold" onclick="alert('Success: Password reset link has been sent to your email.')">Send Link</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Password Visibility Toggle Logic
        const toggleBtn = document.getElementById('toggleLoginPassword');
        const passwordInput = document.getElementById('loginPassword');

        toggleBtn.addEventListener('click', function () {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            this.textContent = isPassword ? 'Hide' : 'Show';
        });

        // Form Submission Logic
        const loginForm = document.getElementById('loginForm');
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            alert("Success: Login credentials submitted for verification.");
        });
    </script>
</body>
</html>