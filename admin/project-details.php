<?php
require_once __DIR__ . '/config/auth.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/helpers.php';
require_login();

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$id) {
    header('Location: projects.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = :id");
$stmt->execute([':id' => $id]);
$project = $stmt->fetch();

if (!$project) {
    flash_set('Project not found.', 'error');
    header('Location: projects.php');
    exit;
}

// Fetch goals
$stmtG = $pdo->prepare("SELECT goal_text FROM project_goals WHERE project_id = :pid ORDER BY sort_order ASC, id ASC");
$stmtG->execute([':pid' => $id]);
$goals = $stmtG->fetchAll(PDO::FETCH_COLUMN);

// Fetch results
$stmtR = $pdo->prepare("SELECT result_text FROM project_results WHERE project_id = :pid ORDER BY sort_order ASC, id ASC");
$stmtR->execute([':pid' => $id]);
$results = $stmtR->fetchAll(PDO::FETCH_COLUMN);

// Fetch gallery images
$stmtI = $pdo->prepare("SELECT image_path FROM project_images WHERE project_id = :pid ORDER BY sort_order ASC, id ASC");
$stmtI->execute([':pid' => $id]);
$images = $stmtI->fetchAll(PDO::FETCH_COLUMN);

$pageTitle  = 'Project Details: ' . $project['title'];
$activeMenu = 'projects';
include __DIR__ . '/includes/header.php';
?>

<div class="panel">
  <div class="panel-head">
    <div>
      <span class="badge <?= e($project['status']) ?>"><?= e(ucfirst($project['status'])) ?></span>
      <h2 style="margin-top:6px; font-size:24px;"><?= e($project['title']) ?></h2>
    </div>
    <div class="actions">
      <a href="project-add.php?id=<?= (int)$project['id'] ?>" class="btn btn-green">Edit Project</a>
      <a href="projects.php" class="btn btn-outline">Back to List</a>
    </div>
  </div>

  <?php if (!empty($project['card_image'])): ?>
    <div style="margin-bottom:20px;">
      <img src="<?= e(admin_image_url($project['card_image'])) ?>" style="max-width:100%; max-height:360px; border-radius:12px; object-fit:cover;">
    </div>
  <?php endif; ?>

  <div style="margin-bottom:24px;">
    <h3>Intro Description</h3>
    <div class="detail-description">
      <?= $project['intro_description'] ?: '<p class="hint">No description provided.</p>' ?>
    </div>
  </div>

  <div class="form-grid" style="margin-bottom:24px;">
    <div>
      <h3>Client Goals</h3>
      <?php if (!empty($goals)): ?>
        <ul class="checklist">
          <?php foreach ($goals as $g): ?>
            <li><?= e($g) ?></li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p class="hint">No client goals recorded.</p>
      <?php endif; ?>
    </div>

    <div>
      <h3>Impact & Results</h3>
      <?php if (!empty($results)): ?>
        <ul class="checklist">
          <?php foreach ($results as $r): ?>
            <li><?= e($r) ?></li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p class="hint">No results recorded.</p>
      <?php endif; ?>
    </div>
  </div>

  <?php if (!empty($images)): ?>
    <div>
      <h3>Project Gallery</h3>
      <div class="gallery-strip">
        <?php foreach ($images as $img): ?>
          <img src="<?= e(admin_image_url($img)) ?>" alt="Project Gallery Photo">
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
