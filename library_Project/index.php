<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Library Management - Login</title>
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
                align-items: center;
                justify-content: center;
                overflow: hidden;
            }

            .login-container {
                width: 100%;
                max-width: 1000px;
                padding: 2rem;
                animation: fadeInUp 0.5s ease-out;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(25px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .login-header {
                text-align: center;
                margin-bottom: 3rem;
            }

            .login-header h1 {
                font-size: 2.5rem;
                font-weight: 700;
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                letter-spacing: 1px;
                margin-bottom: 0.5rem;
            }

            .login-header p {
                color: #cbd5e1;
                font-size: 1rem;
                letter-spacing: 0.5px;
            }

            .login-forms-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
                margin-top: 2rem;
            }

            .login-form-wrapper {
                background: #1a2847;
                border: 1px solid #334155;
                border-radius: 12px;
                padding: 2rem;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
                animation: slideIn 0.5s ease-out;
                transition: all 0.3s ease;
            }

            .login-form-wrapper:hover {
                border-color: rgba(99, 102, 241, 0.6);
                box-shadow: 0 16px 48px rgba(99, 102, 241, 0.2);
                transform: translateY(-2px);
            }

            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .login-form-wrapper:nth-child(1) {
                animation-delay: 0.1s;
            }

            .login-form-wrapper:nth-child(2) {
                animation-delay: 0.2s;
            }

            .login-form-wrapper h3 {
                color: #818cf8;
                font-weight: 700;
                font-size: 1.25rem;
                margin-bottom: 1.5rem;
                letter-spacing: 0.5px;
            }

            .login-form-wrapper:nth-child(1) h3 {
                color: #818cf8;
            }

            .login-form-wrapper:nth-child(2) h3 {
                color: #a78bfa;
            }

            .form-group {
                margin-bottom: 1.25rem;
            }

            .form-group label {
                color: #f1f5f9;
                font-weight: 600;
                font-size: 0.85rem;
                margin-bottom: 0.5rem;
                display: block;
            }

            .form-group input {
                width: 100%;
                padding: 0.75rem 1rem;
                border: 1.5px solid #e2e8f0;
                border-radius: 8px;
                background: #0f172a;
                color: #f1f5f9;
                font-family: 'Inter', sans-serif;
                font-size: 0.95rem;
                transition: all 0.3s ease;
            }

            .form-group input::placeholder {
                color: rgba(203, 213, 225, 0.5);
            }

            .form-group input:focus {
                outline: none;
                border-color: #6366f1;
                background: #0f172a;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
            }

            .error-label {
                color: #fca5a5;
                font-size: 0.8rem;
                margin-top: 0.25rem;
                display: block;
                font-weight: 600;
            }

            .btnSubmit {
                width: 100%;
                padding: 0.85rem;
                border: none;
                border-radius: 8px;
                font-size: 0.95rem;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.3s ease;
                letter-spacing: 0.5px;
                position: relative;
                overflow: hidden;
                margin-top: 1rem;
            }

            .login-form-wrapper:nth-child(1) .btnSubmit {
                background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
                color: #f1f5f9;
            }

            .login-form-wrapper:nth-child(2) .btnSubmit {
                background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
                color: #f1f5f9;
            }

            .btnSubmit:hover {
                transform: translateY(-2px);
                box-shadow: 0 12px 32px rgba(99, 102, 241, 0.3);
            }

            .alert-msg {
                text-align: center;
                padding: 0.85rem;
                margin-bottom: 1.5rem;
                background: rgba(34, 197, 94, 0.1);
                border-left: 4px solid #22c55e;
                border-radius: 8px;
                color: #86efac;
                font-weight: 600;
                animation: slideDownFade 0.3s ease-out;
            }

            @keyframes slideDownFade {
                from {
                    opacity: 0;
                    transform: translateY(-15px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 768px) {
                .login-forms-row {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                }

                .login-header h1 {
                    font-size: 1.8rem;
                }

                .login-form-wrapper {
                    padding: 1.5rem;
                }
            }
        </style>
    </head>
    <body>

    <?php
    $emailmsg = "";
    $pasdmsg = "";
    $msg = "";
    $ademailmsg = "";
    $adpasdmsg = "";

    if(!empty($_REQUEST['ademailmsg'])){
        $ademailmsg = $_REQUEST['ademailmsg'];
    }

    if(!empty($_REQUEST['adpasdmsg'])){
        $adpasdmsg = $_REQUEST['adpasdmsg'];
    }

    if(!empty($_REQUEST['emailmsg'])){
        $emailmsg = $_REQUEST['emailmsg'];
    }

    if(!empty($_REQUEST['pasdmsg'])){
        $pasdmsg = $_REQUEST['pasdmsg'];
    }

    if(!empty($_REQUEST['msg'])){
        $msg = $_REQUEST['msg'];
    }
    ?>

    <div class="login-container">
        <div class="login-header">
            <h1>📚 LIBRARY</h1>
            <p>Management System Portal</p>
        </div>

        <?php if($msg): ?>
            <div class="alert-msg"><?php echo $msg; ?></div>
        <?php endif; ?>

        <div class="login-forms-row">
            <!-- Admin Login Form -->
            <div class="login-form-wrapper">
                <h3>Admin Access</h3>
                <form action="loginadmin_server_page.php" method="get">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" class="form-control" name="login_email" placeholder="admin@example.com" />
                        <?php if($ademailmsg): ?>
                            <span class="error-label">* <?php echo $ademailmsg; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="login_pasword" placeholder="Enter your password" />
                        <?php if($adpasdmsg): ?>
                            <span class="error-label">* <?php echo $adpasdmsg; ?></span>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btnSubmit">Login to Admin</button>
                </form>
            </div>

            <!-- Student Login Form -->
            <div class="login-form-wrapper">
                <h3>Student Access</h3>
                <form action="login_server_page.php" method="get">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" class="form-control" name="login_email" placeholder="student@example.com" />
                        <?php if($emailmsg): ?>
                            <span class="error-label">* <?php echo $emailmsg; ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="login_pasword" placeholder="Enter your password" />
                        <?php if($pasdmsg): ?>
                            <span class="error-label">* <?php echo $pasdmsg; ?></span>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btnSubmit">Login to Portal</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Three.js Canvas -->
    <canvas id="canvas-3d-login"></canvas>

    <script src="animations.js"></script>
    <script>
        document.body.classList.add('login-page');
    </script>



        <script src="" async defer></script>
    </body>
</html>