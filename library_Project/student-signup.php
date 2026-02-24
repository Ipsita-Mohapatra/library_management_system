<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Student Sign Up - Library Management</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="advanced-animations.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
                background-attachment: fixed;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                overflow-x: hidden;
                padding: 2rem 0;
            }

            .signup-container {
                width: 100%;
                max-width: 550px;
                padding: 2rem 1rem;
                animation: fadeInUp 0.5s ease-out;
                margin-top: -40px;
                margin-bottom: 2rem;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .signup-header {
                text-align: center;
                margin-bottom: 2.5rem;
            }

            .logo-container {
                margin-bottom: 1.5rem;
                display: flex;
                justify-content: center;
            }

            .logo-container img {
                height: 80px;
                width: auto;
                border-radius: 12px;
                box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3);
                transition: transform 0.3s ease;
            }

            .logo-container img:hover {
                transform: scale(1.05);
            }

            .signup-header h1 {
                font-size: 2.2rem;
                font-weight: 700;
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                letter-spacing: 1px;
                margin-bottom: 0.5rem;
            }

            .signup-header p {
                color: #cbd5e1;
                font-size: 0.95rem;
                letter-spacing: 0.5px;
            }

            .signup-form-wrapper {
                background: #1a2847;
                border: 1px solid #334155;
                border-radius: 16px;
                padding: 2.5rem;
                box-shadow: 0 16px 40px rgba(0, 0, 0, 0.4);
                animation: slideIn 0.6s ease-out;
            }

            .signup-form-wrapper:hover {
                border-color: #818cf8;
                box-shadow: 0 24px 48px rgba(99, 102, 241, 0.2);
            }

            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateX(20px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .signup-form-wrapper h3 {
                text-align: center;
                color: #818cf8;
                font-size: 1.5rem;
                font-weight: 700;
                margin-bottom: 1.8rem;
                letter-spacing: 0.5px;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-group label {
                display: block;
                color: #cbd5e1;
                font-weight: 600;
                margin-bottom: 0.7rem;
                font-size: 0.9rem;
                letter-spacing: 0.3px;
            }

            .form-group input,
            .form-group select {
                width: 100%;
                padding: 0.9rem 1.2rem;
                border: 1px solid #475569;
                background: #0f172a;
                color: #f1f5f9;
                border-radius: 10px;
                font-size: 0.95rem;
                transition: all 0.3s ease;
                font-family: 'Inter', sans-serif;
            }

            .form-group input::placeholder {
                color: #64748b;
            }

            .form-group input:focus,
            .form-group select:focus {
                outline: none;
                border-color: #818cf8;
                background: #1a2847;
                box-shadow: 0 0 0 3px rgba(129, 140, 248, 0.1);
            }

            .form-group select {
                cursor: pointer;
                appearance: none;
                background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: right 0.7em center;
                background-size: 1.5em 1.5em;
                padding-right: 2.5rem;
            }

            .error-label {
                display: block;
                color: #fca5a5;
                font-size: 0.8rem;
                margin-top: 0.4rem;
                font-weight: 600;
            }

            .success-label {
                display: block;
                color: #86efac;
                font-size: 0.8rem;
                margin-top: 0.4rem;
                font-weight: 600;
            }

            .btnSubmit {
                width: 100%;
                padding: 1rem 1.5rem;
                border: none;
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                color: #fff;
                border-radius: 10px;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.3s ease;
                font-size: 1rem;
                letter-spacing: 0.5px;
                box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            }

            .btnSubmit:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
            }

            .btnSubmit:active {
                transform: translateY(-1px);
            }

            .login-prompt {
                text-align: center;
                margin-top: 2rem;
                padding-top: 2rem;
                border-top: 2px solid #334155;
            }

            .login-prompt p {
                color: #cbd5e1;
                font-size: 0.95rem;
                margin-bottom: 1.2rem;
                font-weight: 500;
            }

            .login-link {
                color: #818cf8;
                text-decoration: none;
                font-weight: 700;
                transition: color 0.3s ease;
                font-size: 0.95rem;
                display: inline-block;
                padding: 0.8rem 2rem;
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                color: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            }

            .login-link:hover {
                color: #fff;
                text-decoration: none;
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
            }

            .back-link {
                text-align: center;
                margin-top: 1rem;
            }

            .back-link a {
                color: #818cf8;
                text-decoration: none;
                font-weight: 600;
                transition: color 0.3s ease;
                font-size: 0.9rem;
            }

            .back-link a:hover {
                color: #c4b5fd;
                text-decoration: underline;
            }

            .alert-msg {
                padding: 1rem 1.2rem;
                border-radius: 10px;
                margin-bottom: 1.5rem;
                font-weight: 600;
                animation: slideDownFade 0.4s ease-out;
            }

            .alert-msg.success {
                color: #86efac;
                background: rgba(134, 239, 172, 0.1);
                border: 1px solid rgba(134, 239, 172, 0.3);
            }

            .alert-msg.error {
                color: #fca5a5;
                background: rgba(252, 165, 165, 0.1);
                border: 1px solid rgba(252, 165, 165, 0.3);
            }

            @keyframes slideDownFade {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .form-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }

            /* ============ FOOTER ============ */
            footer {
                width: 100%;
                background: linear-gradient(180deg,#0f172a 0%, #071033 100%);
                color: #cbd5e1;
                padding: 3rem 1.5rem;
                margin-top: auto;
                box-shadow: 0 -8px 30px rgba(2,6,23,0.6);
            }

            .footer-content {
                max-width: 1100px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 2rem;
                align-items: start;
                margin-bottom: 1.5rem;
            }

            .footer-section {
                text-align: left;
                padding: 0.2rem 0.5rem;
            }

            .footer-section h4 {
                color: #7c3aed;
                font-weight: 700;
                margin-bottom: 0.6rem;
                font-size: 1.05rem;
                letter-spacing: 0.2px;
            }

            .footer-section p,
            .footer-section a,
            .footer-section li {
                color: #cbd5e1;
                font-size: 0.95rem;
                line-height: 1.6;
            }

            .footer-links { list-style: none; padding: 0; margin: 0; }
            .footer-links li { margin: 0.35rem 0; }
            .footer-links a { color: #cbd5e1; text-decoration: none; transition: color 0.2s ease; }
            .footer-links a:hover { color: #a78bfa; text-decoration: none; }

            .social-icons { display:flex; gap:0.6rem; margin-top:0.6rem; }
            .social-icons a { display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius:6px; background: rgba(255,255,255,0.03); color:#cbd5e1; text-decoration:none; transition: transform .15s ease, background .15s ease; }
            .social-icons a:hover { transform: translateY(-3px); background: rgba(124,58,237,0.15); color:#fff; }

            .brand-brief { font-size:0.95rem; color:#cbd5e1; }

            .footer-bottom {
                display:flex; justify-content:space-between; align-items:center; gap:1rem;
                color: #94a3b8; font-size:0.9rem; padding-top:1rem; border-top:1px solid rgba(255,255,255,0.03);
                max-width:1100px; margin:0 auto;
            }

            @media (max-width:800px){
                .footer-content { grid-template-columns: 1fr; text-align:center; }
                .footer-section { text-align:center; }
                .footer-bottom { flex-direction:column; gap:0.5rem; }
            }

            @media (max-width: 768px) {
                .signup-container {
                    padding: 1rem;
                }

                .signup-form-wrapper {
                    padding: 1.8rem;
                }

                .signup-header h1 {
                    font-size: 1.8rem;
                }

                .logo-container img {
                    height: 60px;
                }

                .form-row {
                    grid-template-columns: 1fr;
                }

                .footer-content {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                }

                footer {
                    padding: 1.5rem 1rem;
                }
            }
        </style>
    </head>
    <body>

    <?php
    $success_msg = "";
    $error_msg = "";

    if(!empty($_REQUEST['msg'])){
        $success_msg = $_REQUEST['msg'];
    }

    if(!empty($_REQUEST['error'])){
        $error_msg = $_REQUEST['error'];
    }
    ?>

    <div class="signup-container">
        <div class="signup-header">
            <div class="logo-container">
                <img src="images/logo1.png" alt="Library Logo" />
            </div>
            <!-- <h1>📚 LIBRARY</h1>
            <p>Create Your Account</p> -->
        </div>

        <?php if($success_msg): ?>
            <div class="alert-msg success"><?php echo htmlspecialchars($success_msg); ?></div>
        <?php endif; ?>

        <?php if($error_msg): ?>
            <div class="alert-msg error"><?php echo htmlspecialchars($error_msg); ?></div>
        <?php endif; ?>

        <div class="signup-form-wrapper">
            <h3>Student Registration</h3>
            <form method="POST" action="addpersonserver_page.php" onsubmit="return validateSignupForm()">
                <div class="form-row">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="addname" placeholder="Enter your full name" required>
                    </div>

                    <div class="form-group">
                        <label for="accountType">Account Type</label>
                        <select id="accountType" name="type" required>
                            <option value="">Select Type</option>
                            <option value="student">Student</option>
                            <option value="student">Teacher</option>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="addemail" placeholder="Enter your email address" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="addpass" placeholder="Create a password" required minlength="6">
                        <span class="success-label">At least 6 characters</span>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" placeholder="Confirm your password" required>
                    </div>
                </div>

                <button type="submit" class="btnSubmit">Create Account</button>
            </form>

            <div class="login-prompt">
                <p>Already have an account?</p>
                <a href="student-login.php" class="login-link">Login Here</a>
            </div>

            <div class="back-link">
                <a href="index.php">← Back to Home</a>
            </div>
        </div>
    </div>

    <script>
        function validateSignupForm() {
            const fullName = document.getElementById('fullName').value.trim();
            const email = document.getElementById('email').value.trim();
            const accountType = document.getElementById('accountType').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (fullName === '') {
                alert('Please enter your full name!');
                document.getElementById('fullName').focus();
                return false;
            }

            if (email === '') {
                alert('Please enter your email address!');
                document.getElementById('email').focus();
                return false;
            }

            if (accountType === '') {
                alert('Please select an account type!');
                document.getElementById('accountType').focus();
                return false;
            }

            if (password === '') {
                alert('Please enter a password!');
                document.getElementById('password').focus();
                return false;
            }

            if (password.length < 6) {
                alert('Password must be at least 6 characters long!');
                document.getElementById('password').focus();
                return false;
            }

            if (confirmPassword === '') {
                alert('Please confirm your password!');
                document.getElementById('confirmPassword').focus();
                return false;
            }

            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                document.getElementById('confirmPassword').focus();
                return false;
            }

            return true;
        }
    </script>

    <!-- Three.js Canvas -->
    <canvas id="canvas-3d-login"></canvas>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Library Management</h4>
                <p class="brand-brief">A modern, secure library system to manage inventory, lending and users — built for educational institutions.</p>
                <div class="social-icons">
                    <a href="#" aria-label="Twitter">🐦</a>
                    <a href="#" aria-label="LinkedIn">🔗</a>
                    <a href="#" aria-label="Email">✉️</a>
                </div>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="student-login.php">Student Login</a></li>
                    <li><a href="admin-login.php">Admin Login</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Contact</h4>
                <p>Email: <a href="mailto:info@libraryms.com">info@libraryms.com</a></p>
                <p>Phone: +1 (555) 123-4567</p>
                <p>Address: 123 Library Avenue, Knowledge City</p>
            </div>
        </div>
        <div class="footer-bottom">
            <div>&copy; 2026 Library Management System</div>
            <div>Made with ❤️ — All rights reserved.</div>
        </div>
    </footer>

    <script src="animations.js"></script>
    <script>
        document.body.classList.add('login-page');
    </script>

    </body>
</html>
