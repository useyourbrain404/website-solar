<?php
require_once __DIR__ . '/config/auth.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/helpers.php';
require_login();

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$id) {
    header('Location: services.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM services WHERE id = :id");
$stmt->execute([':id' => $id]);
$service = $stmt->fetch();

if (!$service) {
    flash_set('Service not found.', 'error');
    header('Location: services.php');
    exit;
}

$pageTitle  = 'Service Details: ' . $service['title'];
$activeMenu = 'services';
include __DIR__ . '/includes/header.php';
?>

<div class="panel">
  <div class="panel-head">
    <div>
      <span class="badge <?= e($service['status']) ?>"><?= e(ucfirst($service['status'])) ?></span>
      <h2 style="margin-top:6px; font-size:24px;"><?= e($service['title']) ?></h2>
    </div>
    <div class="actions">
      <a href="service-add.php?id=<?= (int)$service['id'] ?>" class="btn btn-green">Edit Service</a>
      <a href="services.php" class="btn btn-outline">Back to List</a>
    </div>
  </div>

  <?php if (!empty($service['card_image'])): ?>
    <div style="margin-bottom:24px;">
      <h4 style="margin-bottom:8px; color:var(--text-muted);">Listing Card Image</h4>
      <img src="<?= e(admin_image_url($service['card_image'])) ?>" style="max-width:280px; border-radius:10px; object-fit:cover;">
    </div>
  <?php endif; ?>

  <div style="margin-bottom:24px;">
    <h4 style="margin-bottom:8px; color:var(--text-muted);">Short Description (Card Blurb)</h4>
    <div><?= $service['short_description'] ?: '<em>None</em>' ?></div>
  </div>

  <hr style="border:none;border-top:1px solid #e7eaf3;margin:20px 0 24px;">

  <?php if (!empty($service['tag_label'])): ?>
    <div class="detail-tag"><?= e($service['tag_label']) ?></div>
  <?php endif; ?>

  <?php if (!empty($service['heading'])): ?>
    <div class="detail-heading"><?= e($service['heading']) ?></div>
  <?php endif; ?>

  <?php if (!empty($service['detail_image1']) || !empty($service['detail_image2'])): ?>
    <div class="detail-images">
      <?php if (!empty($service['detail_image1'])): ?>
        <img src="<?= e(admin_image_url($service['detail_image1'])) ?>" alt="Detail Image 1">
      <?php endif; ?>
      <?php if (!empty($service['detail_image2'])): ?>
        <img src="<?= e(admin_image_url($service['detail_image2'])) ?>" alt="Detail Image 2">
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div style="margin-top:16px;">
    <h3>Long Description</h3>
    <div class="detail-description">
      <?= $service['long_description'] ?: '<p class="hint">No detail description provided.</p>' ?>
    </div>
  </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
