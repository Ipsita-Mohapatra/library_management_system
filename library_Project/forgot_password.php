<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Reset Password · Library Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root{--bg:#081028;--card:#0f172a;--accent:#7c3aed;--muted:#94a3b8;--glass:rgba(255,255,255,0.04)}
        *{box-sizing:border-box;font-family:Inter,system-ui,Segoe UI,Roboto,'Helvetica Neue',Arial}
        body{margin:0;min-height:100vh;background:linear-gradient(180deg,var(--bg) 0%, #071033 100%);display:flex;align-items:center;justify-content:center;padding:2rem;color:#e6eef8}
        .wrap{width:100%;max-width:920px;display:grid;grid-template-columns:1fr 420px;gap:2rem;align-items:center}
        .intro{padding:2.2rem;border-radius:12px;background:linear-gradient(180deg,rgba(255,255,255,0.02),transparent);box-shadow:0 8px 30px rgba(2,6,23,0.6);backdrop-filter:blur(6px)}
        .logo{display:flex;align-items:center;gap:12px}
        .logo img{width:70px;height:28px;border-radius:8px;object-fit:cover}
        .title{font-size:1.6rem;font-weight:700;margin:0 0 .25rem}
        .subtitle{color:var(--muted);margin:0 0 1rem}
        .card{background:linear-gradient(180deg,var(--card), #061025);padding:2rem;border-radius:12px;box-shadow:0 12px 40px rgba(2,6,23,0.7);border:1px solid rgba(255,255,255,0.03)}
        form{display:flex;flex-direction:column;gap:1rem}
        label{font-size:.9rem;color:var(--muted);margin-bottom:.25rem}
        input[type=email],input[type=password]{padding:.9rem 1rem;border-radius:10px;border:1px solid rgba(255,255,255,0.06);background:var(--glass);color:#e6eef8;outline:none}
        input::placeholder{color:#9aa7bf}
        input:focus{box-shadow:0 6px 20px rgba(124,58,237,0.12);border-color:var(--accent)}
        .btn{display:inline-flex;align-items:center;justify-content:center;padding:.85rem 1rem;border-radius:10px;border:none;background:linear-gradient(90deg,var(--accent),#5b21b6);color:white;font-weight:600;cursor:pointer;box-shadow:0 8px 24px rgba(124,58,237,0.18)}
        .muted-link{color:var(--muted);font-size:.9rem;text-decoration:none}
        .muted-link:hover{color:#fff}
        .help{font-size:.85rem;color:var(--muted);margin-top:.25rem}
        .footer-note{font-size:.85rem;color:var(--muted);margin-top:1rem}
        @media (max-width:900px){.wrap{grid-template-columns:1fr;max-width:520px;padding:1rem}.intro{order:2}.card{order:1}}
    </style>
</head>
<body>
    <div class="wrap">
        <div class="intro">
            <div class="logo">
                <img src="images/logo1.png" alt="Library logo">
                <div>
                    <h1 class="title">Library Account Recovery</h1>
                    <p class="subtitle">Reset your account password securely. Use the email you registered with.</p>
                </div>
            </div>
            <p class="help">For security, admins and students have separate reset pages. If you are an administrator, use the Admin Reset link below.</p>
            <p class="footer-note">Need help? Contact support at <a class="muted-link" href="mailto:info@libraryms.com">info@libraryms.com</a></p>
        </div>

        <div class="card">
            <h2 style="margin:0 0 .5rem">Reset password</h2>
            <p style="margin:0 0 1rem;color:var(--muted)">Enter your registered email and choose a strong password (min 6 characters).</p>
            <form action="reset_password_server.php" method="post">
                <input type="hidden" name="role" value="user" />
                <div>
                    <label for="email">Registered Email</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required />
                </div>
                <div>
                    <label for="newpass">New Password</label>
                    <input type="password" id="newpass" name="newpass" placeholder="New password" required minlength="6" />
                </div>
                <div style="display:flex;gap:.75rem;align-items:center;margin-top:.25rem">
                    <button class="btn" type="submit">Reset Password</button>
                    <a class="muted-link" href="student-login.php">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>