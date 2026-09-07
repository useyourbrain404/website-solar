<?php
require_once __DIR__ . '/config/auth.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/helpers.php';
require_login();

// Handle status updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $enqId  = (int)$_POST['enquiry_id'];
    $status = $_POST['status'];
    if (in_array($status, ['new', 'contacted', 'closed'])) {
        $stmt = $pdo->prepare("UPDATE enquiries SET status = :status WHERE id = :id");
        $stmt->execute([':status' => $status, ':id' => $enqId]);
        flash_set('Enquiry status updated.');
    }
    header('Location: enquiries.php');
    exit;
}

// Handle delete
if (isset($_GET['delete_id'])) {
    $enqId = (int)$_GET['delete_id'];
    $pdo->prepare("DELETE FROM enquiries WHERE id = :id")->execute([':id' => $enqId]);
    flash_set('Enquiry deleted.');
    header('Location: enquiries.php');
    exit;
}

$enquiries = $pdo->query("SELECT * FROM enquiries ORDER BY id DESC")->fetchAll();

$pageTitle  = 'Enquiries';
$activeMenu = 'enquiries';
include __DIR__ . '/includes/header.php';
?>

<div class="panel">
  <div class="panel-head">
    <div>
      <h2>Customer Enquiries</h2>
      <p style="margin: 4px 0 0; font-size: 13.5px; color: var(--text-muted);">View, manage, and track quote requests submitted by website visitors.</p>
    </div>
  </div>

  <?php if ($enquiries): ?>
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 130px;">Date</th>
          <th style="width: 170px;">Customer</th>
          <th style="width: 190px;">Contact Details</th>
          <th style="width: 160px;">Interest</th>
          <th>Message</th>
          <th style="width: 130px; text-align: center;">Status</th>
          <th style="width: 100px; text-align: right;">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($enquiries as $e): ?>
        <tr>
          <td style="font-size: 13px; color: var(--text-muted); white-space: nowrap;">
            <?= date('M d, Y', strtotime($e['created_at'])) ?><br>
            <span style="font-size: 11.5px;"><?= date('h:i A', strtotime($e['created_at'])) ?></span>
          </td>
          <td>
            <strong style="color: var(--navy); font-size: 14px;"><?= e($e['name']) ?></strong>
          </td>
          <td>
            <a href="mailto:<?= e($e['email']) ?>" style="color: #2563eb; font-size: 13px; display: block;"><?= e($e['email']) ?></a>
            <?php if (!empty($e['phone'])): ?>
              <a href="tel:<?= e($e['phone']) ?>" style="font-size: 12.5px; color: var(--text-muted); display: block; margin-top: 2px;">
                📞 <?= e($e['phone']) ?>
              </a>
            <?php endif; ?>
          </td>
          <td>
            <span class="badge" style="background: #f1f5f9; color: var(--navy); font-weight: 600;">
              <?= e($e['service_interested'] ?: 'General Quote') ?>
            </span>
          </td>
          <td>
            <div style="font-size: 13.5px; line-height: 1.5; color: #334155; max-width: 320px; word-wrap: break-word;">
              <?= nl2br(e($e['message'])) ?>
            </div>
          </td>
          <td style="text-align: center;">
            <form method="POST" style="margin:0;">
              <input type="hidden" name="enquiry_id" value="<?= $e['id'] ?>">
              <input type="hidden" name="update_status" value="1">
              <select name="status" onchange="this.form.submit()" style="padding: 5px 8px; font-size: 12px; font-weight: 600; border-radius: 6px; cursor: pointer; border: 1px solid var(--border); width: 110px;">
                <option value="new" <?= $e['status']==='new'?'selected':'' ?>>🟠 New</option>
                <option value="contacted" <?= $e['status']==='contacted'?'selected':'' ?>>🔵 Contacted</option>
                <option value="closed" <?= $e['status']==='closed'?'selected':'' ?>>🟢 Closed</option>
              </select>
            </form>
          </td>
          <td>
            <div class="actions" style="justify-content: flex-end;">
              <a href="enquiries.php?delete_id=<?= (int)$e['id'] ?>" class="btn-action btn-delete confirm-delete" title="Delete enquiry">Delete</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php else: ?>
    <div class="empty-state">
      <div style="font-size: 36px; margin-bottom: 8px;">✉</div>
      <p style="font-size: 15px; margin-bottom: 12px;">No customer enquiries found.</p>
    </div>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
