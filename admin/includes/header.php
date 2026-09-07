<?php
// Expects $pageTitle and $activeMenu to be set by the including page.
$pageTitle  = $pageTitle  ?? 'Dashboard';
$activeMenu = $activeMenu ?? '';

// Check for new enquiries badge
$newEnqCount = 0;
if (isset($pdo)) {
    try {
        $newEnqCount = (int)$pdo->query("SELECT COUNT(*) FROM enquiries WHERE status = 'new'")->fetchColumn();
    } catch (Exception $e) {
        $newEnqCount = 0;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($pageTitle) ?> · AK Energies Admin</title>
<link rel="icon" type="image/webp" href="../images/logo-icon-clean.webp">
<link rel="stylesheet" href="assets/css/style.css?v=1.2">
</head>
<body>
<div class="app">

  <aside class="sidebar" id="sidebar">
    <div class="brand">
      <a href="dashboard.php" title="AK Energies Dashboard">
        <img src="../images/logo-light.png" alt="AK Energies" class="admin-logo">
      </a>
    </div>
    <nav>
      <a href="dashboard.php" class="<?= $activeMenu==='dashboard'?'active':'' ?>">
        <span class="icon">&#9632;</span> Dashboard
      </a>
      <a href="services.php" class="<?= $activeMenu==='services'?'active':'' ?>">
        <span class="icon">&#9737;</span> Services
      </a>
      <a href="service-add.php" class="<?= $activeMenu==='service-add'?'active':'' ?>">
        <span class="icon">&#43;</span> Add Service
      </a>
      <a href="projects.php" class="<?= $activeMenu==='projects'?'active':'' ?>">
        <span class="icon">&#9733;</span> Projects
      </a>
      <a href="project-add.php" class="<?= $activeMenu==='project-add'?'active':'' ?>">
        <span class="icon">&#43;</span> Add Project
      </a>
      <a href="enquiries.php" class="<?= $activeMenu==='enquiries'?'active':'' ?>" style="display:flex; align-items:center; justify-content:space-between;">
        <span style="display:flex; align-items:center; gap:12px;">
          <span class="icon">&#9993;</span> Enquiries
        </span>
        <?php if ($newEnqCount > 0): ?>
          <span style="background:var(--accent); color:#ffffff; font-size:11px; font-weight:700; padding:2px 8px; border-radius:10px; box-shadow:0 2px 6px rgba(103,129,47,0.4);"><?= $newEnqCount ?></span>
        <?php endif; ?>
      </a>
    </nav>
    <div class="logout">
      <a href="../index.php" target="_blank" class="site-link">
        <span>&#8599;</span> View Website
      </a>
      <a href="logout.php" class="logout-link">&#8592; Logout</a>
    </div>
  </aside>

  <div class="main">
    <div class="topbar">
      <h1><?= e($pageTitle) ?></h1>
      <div style="display:flex; align-items:center; gap:16px;">
        <a href="../index.php" target="_blank" class="btn btn-outline btn-sm" style="font-weight:600;">
          <span>&#8599;</span> Live Website
        </a>
        <div class="user">
          <div class="avatar"><?= e(strtoupper(substr(current_admin_name(),0,1))) ?></div>
          <span><?= e(current_admin_name()) ?></span>
        </div>
      </div>
    </div>
    <div class="content">
      <?php $flash = flash_get(); if ($flash): ?>
        <div class="alert <?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
      <?php endif; ?>
