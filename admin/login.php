<?php
require_once __DIR__ . '/config/auth.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/helpers.php';

if (!empty($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = :u LIMIT 1");
    $stmt->execute([':u' => $username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id']   = $admin['id'];
        $_SESSION['admin_name'] = $admin['full_name'] ?: $admin['username'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login · AK Energies</title>
<link rel="icon" type="image/webp" href="../images/logo-icon-clean.webp">
<link rel="stylesheet" href="assets/css/style.css?v=1.1">
</head>
<body>
<div class="login-wrap">
  <div class="login-container">
    <div class="login-card">
      <div class="logo-box">
        <a href="../index.php" title="AK Energies">
          <img src="../images/logo-white.webp" alt="AK Energies">
        </a>
      </div>

      <div style="text-align:center;">
        <div class="badge-tag">
          <span class="dot"></span> Admin Control Center
        </div>
        <h2>Portal Sign In</h2>
        <p class="sub">Enter your administrator credentials to access the AK Energies management system</p>
      </div>

      <?php if ($error): ?>
        <div class="alert error" style="display:flex; align-items:center; gap:10px;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          <span><?= e($error) ?></span>
        </div>
      <?php endif; ?>

      <form method="POST" autocomplete="on">
        <div class="form-group">
          <label for="username">Username</label>
          <div class="input-icon-wrap">
            <input type="text" id="username" name="username" required autofocus placeholder="Enter your username" value="<?= isset($_POST['username']) ? e($_POST['username']) : '' ?>">
            <span class="input-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </span>
          </div>
        </div>

        <div class="form-group">
          <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
            <label for="password" style="margin-bottom:0;">Password</label>
          </div>
          <div class="input-icon-wrap">
            <input type="password" id="password" name="password" required placeholder="Enter your password">
            <span class="input-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </span>
            <button type="button" class="toggle-pwd" id="togglePwd" title="Show or hide password" aria-label="Toggle password visibility">
              <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </div>

        <button type="submit" class="btn btn-accent">
          <span>Sign In to Dashboard</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </button>
      </form>

      <div class="login-footer-links">
        <a href="../index.php" target="_blank">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
          Visit Live Website
        </a>
        <span style="color:var(--text-muted); font-size:12px; font-weight:600;">AK Energies Portal</span>
      </div>
    </div>

    <div class="login-bottom-note">
      Secure Access &middot; &copy; <?= date('Y') ?> <a href="../index.php" target="_blank">AK Energies</a> &middot; All rights reserved
    </div>
  </div>
</div>

<script>
const toggleBtn = document.getElementById('togglePwd');
const pwdInput = document.getElementById('password');
if (toggleBtn && pwdInput) {
  toggleBtn.addEventListener('click', function() {
    const isPwd = pwdInput.type === 'password';
    pwdInput.type = isPwd ? 'text' : 'password';
    toggleBtn.innerHTML = isPwd 
      ? '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>'
      : '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
  });
}
</script>
</body>
</html>
