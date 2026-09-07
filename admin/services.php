<?php
require_once __DIR__ . '/config/auth.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/helpers.php';
require_login();

$services = $pdo->query("SELECT * FROM services ORDER BY sort_order ASC, id DESC")->fetchAll();

$pageTitle  = 'Services';
$activeMenu = 'services';
include __DIR__ . '/includes/header.php';
?>

<div class="panel">
  <div class="panel-head">
    <div>
      <h2>All Services</h2>
      <p style="margin: 4px 0 0; font-size: 13.5px; color: var(--text-muted);">Manage and customize solar services offered on your website.</p>
    </div>
    <a href="service-add.php" class="btn btn-accent">+ Add Service</a>
  </div>

  <?php if ($services): ?>
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 80px; text-align: center;">Image</th>
          <th style="width: 240px;">Title</th>
          <th>Short Description</th>
          <th style="width: 100px; text-align: center;">Status</th>
          <th style="width: 190px; text-align: right;">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($services as $s): 
          $thumbUrl = admin_image_url($s['card_image']);
          $shortExcerpt = strip_tags($s['short_description']);
          if (mb_strlen($shortExcerpt) > 110) {
            $shortExcerpt = mb_substr($shortExcerpt, 0, 110) . '...';
          }
        ?>
        <tr>
          <td style="text-align: center;">
            <img class="thumb" src="<?= e($thumbUrl) ?>" alt="<?= e($s['title']) ?>" onerror="this.src='https://placehold.co/100x100?text=No+Img'">
          </td>
          <td>
            <strong style="color: var(--navy); font-size: 14.5px; display: block; margin-bottom: 2px;"><?= e($s['title']) ?></strong>
            <span style="font-size: 12px; color: var(--text-muted);"><?= e($s['tag_label'] ?: 'Solar Service') ?></span>
          </td>
          <td>
            <div style="color: #475569; font-size: 13.5px; line-height: 1.5;"><?= e($shortExcerpt ?: 'No description entered.') ?></div>
          </td>
          <td style="text-align: center;">
            <span class="badge <?= e($s['status']) ?>"><?= e(ucfirst($s['status'])) ?></span>
          </td>
          <td>
            <div class="actions" style="justify-content: flex-end;">
              <a href="service-details.php?id=<?= (int)$s['id'] ?>" class="btn-action btn-view" title="View details">Details</a>
              <a href="service-add.php?id=<?= (int)$s['id'] ?>" class="btn-action btn-edit" title="Edit service">Edit</a>
              <a href="service-delete.php?id=<?= (int)$s['id'] ?>" class="btn-action btn-delete confirm-delete" title="Delete service">Delete</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php else: ?>
    <div class="empty-state">
      <div style="font-size: 36px; margin-bottom: 8px;">◈</div>
      <p style="font-size: 15px; margin-bottom: 12px;">No services added yet.</p>
      <a href="service-add.php" class="btn btn-accent btn-sm">+ Create Your First Service</a>
    </div>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
