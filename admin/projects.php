<?php
require_once __DIR__ . '/config/auth.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/helpers.php';
require_login();

$projects = $pdo->query("SELECT * FROM projects ORDER BY sort_order ASC, id DESC")->fetchAll();

$pageTitle  = 'Projects';
$activeMenu = 'projects';
include __DIR__ . '/includes/header.php';
?>

<div class="panel">
  <div class="panel-head">
    <div>
      <h2>All Projects</h2>
      <p style="margin: 4px 0 0; font-size: 13.5px; color: var(--text-muted);">Manage your solar installation portfolio and client case studies.</p>
    </div>
    <a href="project-add.php" class="btn btn-accent">+ Add Project</a>
  </div>

  <?php if ($projects): ?>
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 80px; text-align: center;">Image</th>
          <th style="width: 220px;">Title</th>
          <th>Intro Description</th>
          <th style="width: 100px; text-align: center;">Status</th>
          <th style="width: 190px; text-align: right;">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($projects as $p): 
          $thumbUrl = admin_image_url($p['card_image']);
          $introExcerpt = strip_tags($p['intro_description']);
          if (mb_strlen($introExcerpt) > 110) {
            $introExcerpt = mb_substr($introExcerpt, 0, 110) . '...';
          }
        ?>
        <tr>
          <td style="text-align: center;">
            <img class="thumb" src="<?= e($thumbUrl) ?>" alt="<?= e($p['title']) ?>" onerror="this.src='https://placehold.co/100x100?text=No+Img'">
          </td>
          <td>
            <strong style="color: var(--navy); font-size: 14.5px; display: block; margin-bottom: 2px;"><?= e($p['title']) ?></strong>
            <span style="font-size: 12px; color: var(--text-muted);">Slug: <?= e($p['slug']) ?></span>
          </td>
          <td>
            <div style="color: #475569; font-size: 13.5px; line-height: 1.5;"><?= e($introExcerpt ?: 'No description entered.') ?></div>
          </td>
          <td style="text-align: center;">
            <span class="badge <?= e($p['status']) ?>"><?= e(ucfirst($p['status'])) ?></span>
          </td>
          <td>
            <div class="actions" style="justify-content: flex-end;">
              <a href="project-details.php?id=<?= (int)$p['id'] ?>" class="btn-action btn-view" title="View details">Details</a>
              <a href="project-add.php?id=<?= (int)$p['id'] ?>" class="btn-action btn-edit" title="Edit project">Edit</a>
              <a href="project-delete.php?id=<?= (int)$p['id'] ?>" class="btn-action btn-delete confirm-delete" title="Delete project">Delete</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php else: ?>
    <div class="empty-state">
      <div style="font-size: 36px; margin-bottom: 8px;">★</div>
      <p style="font-size: 15px; margin-bottom: 12px;">No projects added yet.</p>
      <a href="project-add.php" class="btn btn-accent btn-sm">+ Create Your First Project</a>
    </div>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
