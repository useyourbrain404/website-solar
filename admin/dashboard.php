<?php
require_once __DIR__ . '/config/auth.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/helpers.php';
require_login();

// Fetch summary metrics
$servicesCount  = (int)$pdo->query("SELECT COUNT(*) FROM services")->fetchColumn();
$projectsCount  = (int)$pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();
$enquiriesCount = (int)$pdo->query("SELECT COUNT(*) FROM enquiries")->fetchColumn();
$newEnquiries   = (int)$pdo->query("SELECT COUNT(*) FROM enquiries WHERE status = 'new'")->fetchColumn();

// Fetch recent services and projects
$recentServices  = $pdo->query("SELECT * FROM services ORDER BY id DESC LIMIT 5")->fetchAll();
$recentProjects  = $pdo->query("SELECT * FROM projects ORDER BY id DESC LIMIT 5")->fetchAll();
$recentEnquiries = $pdo->query("SELECT * FROM enquiries ORDER BY id DESC LIMIT 5")->fetchAll();

$pageTitle  = 'Dashboard';
$activeMenu = 'dashboard';
include __DIR__ . '/includes/header.php';
?>

<div class="stat-grid">
  <div class="stat-card">
    <div class="stat-icon blue">&#9737;</div>
    <div>
      <div class="stat-number"><?= $servicesCount ?></div>
      <div class="stat-label">Total Services</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon green">&#9733;</div>
    <div>
      <div class="stat-number"><?= $projectsCount ?></div>
      <div class="stat-label">Total Projects</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon yellow">&#9993;</div>
    <div>
      <div class="stat-number"><?= $enquiriesCount ?></div>
      <div class="stat-label">Total Enquiries <?php if ($newEnquiries > 0): ?><span style="color:#b45309; font-weight:700;">(<?= $newEnquiries ?> New)</span><?php endif; ?></div>
    </div>
  </div>
</div>

<div class="form-grid-2" style="margin-bottom:26px;">
  <!-- Recent Services Panel -->
  <div class="panel" style="margin-bottom:0;">
    <div class="panel-head">
      <h2>Recent Services</h2>
      <a href="service-add.php" class="btn btn-sm btn-accent">+ Add Service</a>
    </div>
    <?php if ($recentServices): ?>
      <div class="table-responsive">
        <table class="data-table">
          <thead>
            <tr>
              <th style="width: 70px; text-align: center;">Image</th>
              <th>Title</th>
              <th style="width: 90px; text-align: center;">Status</th>
              <th style="width: 80px; text-align: right;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recentServices as $s): ?>
              <tr>
                <td style="text-align: center;">
                  <img src="<?= e(admin_image_url($s['card_image'])) ?>" style="width: 44px; height: 44px; border-radius: 6px; object-fit: cover; border: 1px solid var(--border); display: inline-block; vertical-align: middle;" alt="">
                </td>
                <td style="vertical-align: middle;">
                  <strong style="color: var(--navy); font-size: 13.5px;"><?= e($s['title']) ?></strong>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                  <span class="badge <?= e($s['status']) ?>"><?= e(ucfirst($s['status'])) ?></span>
                </td>
                <td style="text-align: right; vertical-align: middle;">
                  <a href="service-add.php?id=<?= $s['id'] ?>" class="btn-action btn-edit">Edit</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <div class="empty-state">No services added yet.</div>
    <?php endif; ?>
  </div>

  <!-- Recent Projects Panel -->
  <div class="panel" style="margin-bottom:0;">
    <div class="panel-head">
      <h2>Recent Projects</h2>
      <a href="project-add.php" class="btn btn-sm btn-accent">+ Add Project</a>
    </div>
    <?php if ($recentProjects): ?>
      <div class="table-responsive">
        <table class="data-table">
          <thead>
            <tr>
              <th style="width: 70px; text-align: center;">Image</th>
              <th>Title</th>
              <th style="width: 90px; text-align: center;">Status</th>
              <th style="width: 80px; text-align: right;">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recentProjects as $p): ?>
              <tr>
                <td style="text-align: center;">
                  <img src="<?= e(admin_image_url($p['card_image'])) ?>" style="width: 44px; height: 44px; border-radius: 6px; object-fit: cover; border: 1px solid var(--border); display: inline-block; vertical-align: middle;" alt="">
                </td>
                <td style="vertical-align: middle;">
                  <strong style="color: var(--navy); font-size: 13.5px;"><?= e($p['title']) ?></strong>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                  <span class="badge <?= e($p['status']) ?>"><?= e(ucfirst($p['status'])) ?></span>
                </td>
                <td style="text-align: right; vertical-align: middle;">
                  <a href="project-add.php?id=<?= $p['id'] ?>" class="btn-action btn-edit">Edit</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <div class="empty-state">No projects added yet.</div>
    <?php endif; ?>
  </div>
</div>

<!-- Recent Enquiries Panel -->
<div class="panel">
  <div class="panel-head">
    <div>
      <h2>Recent Enquiries</h2>
      <p style="margin: 4px 0 0; font-size: 13px; color: var(--text-muted);">Latest incoming quote submissions from the website contact form.</p>
    </div>
    <a href="enquiries.php" class="btn btn-sm btn-outline">View All &rarr;</a>
  </div>
  <?php if ($recentEnquiries): ?>
    <div class="table-responsive">
      <table class="data-table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Name</th>
            <th>Contact Details</th>
            <th>Interest</th>
            <th>Message</th>
            <th style="text-align: center;">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($recentEnquiries as $enq): ?>
            <tr>
              <td style="font-size: 13px; color: var(--text-muted); white-space: nowrap;">
                <?= date('M d, Y', strtotime($enq['created_at'])) ?>
              </td>
              <td><strong style="color: var(--navy);"><?= e($enq['name']) ?></strong></td>
              <td>
                <a href="mailto:<?= e($enq['email']) ?>" style="color: #2563eb; font-size: 13px;"><?= e($enq['email']) ?></a>
                <?php if (!empty($enq['phone'])): ?>
                  <div style="font-size: 12px; color: var(--text-muted);"><?= e($enq['phone']) ?></div>
                <?php endif; ?>
              </td>
              <td>
                <span class="badge" style="background: #f1f5f9; color: var(--navy);">
                  <?= e($enq['service_interested'] ?: 'General') ?>
                </span>
              </td>
              <td>
                <div style="font-size: 13px; color: #475569; max-width: 280px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                  <?= e($enq['message']) ?>
                </div>
              </td>
              <td style="text-align: center;">
                <span class="badge <?= e($enq['status']) ?>"><?= e(ucfirst($enq['status'])) ?></span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="empty-state">No enquiries received yet.</div>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
