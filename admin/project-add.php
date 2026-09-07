<?php
require_once __DIR__ . '/config/auth.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/helpers.php';
require_login();

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$project = [
    'title' => '', 'card_image' => '', 'intro_description' => '', 'status' => 'active'
];
$goals = [];
$results = [];
$existing_images = [];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $found = $stmt->fetch();
    if (!$found) {
        flash_set('Project not found.', 'error');
        header('Location: projects.php');
        exit;
    }
    $project = $found;

    // Fetch goals
    $stmtG = $pdo->prepare("SELECT goal_text FROM project_goals WHERE project_id = :pid ORDER BY sort_order ASC, id ASC");
    $stmtG->execute([':pid' => $id]);
    $goals = $stmtG->fetchAll(PDO::FETCH_COLUMN);

    // Fetch results
    $stmtR = $pdo->prepare("SELECT result_text FROM project_results WHERE project_id = :pid ORDER BY sort_order ASC, id ASC");
    $stmtR->execute([':pid' => $id]);
    $results = $stmtR->fetchAll(PDO::FETCH_COLUMN);

    // Fetch gallery images
    $stmtI = $pdo->prepare("SELECT * FROM project_images WHERE project_id = :pid ORDER BY sort_order ASC, id ASC");
    $stmtI->execute([':pid' => $id]);
    $existing_images = $stmtI->fetchAll();
}

// Handle image deletion action during edit
if (isset($_GET['delete_img']) && $id) {
    $imgId = (int)$_GET['delete_img'];
    $stmtDelImg = $pdo->prepare("SELECT image_path FROM project_images WHERE id = :id AND project_id = :pid");
    $stmtDelImg->execute([':id' => $imgId, ':pid' => $id]);
    $imgRow = $stmtDelImg->fetch();
    if ($imgRow) {
        @unlink(__DIR__ . '/uploads/' . $imgRow['image_path']);
        $pdo->prepare("DELETE FROM project_images WHERE id = :id")->execute([':id' => $imgId]);
        flash_set('Gallery image deleted.');
    }
    header('Location: project-add.php?id=' . $id);
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title             = trim($_POST['title'] ?? '');
    $intro_description = $_POST['intro_description'] ?? '';
    $status            = ($_POST['status'] ?? 'active') === 'inactive' ? 'inactive' : 'active';
    $submitted_goals   = $_POST['goals'] ?? [];
    $submitted_results = $_POST['results'] ?? [];

    if ($title === '') {
        $errors[] = 'Project title is required.';
    }

    if (!$errors) {
        $slug = unique_slug($pdo, 'projects', $title, $id);
        $cardImage = handle_upload('card_image', 'projects');

        if ($id) {
            $sql = "UPDATE projects SET title=:title, slug=:slug, intro_description=:idesc, status=:status"
                 . ($cardImage ? ", card_image=:card_image" : "")
                 . " WHERE id=:id";
            $params = [
                ':title' => $title, ':slug' => $slug, ':idesc' => $intro_description,
                ':status' => $status, ':id' => $id
            ];
            if ($cardImage) $params[':card_image'] = $cardImage;
            $pdo->prepare($sql)->execute($params);
            $projectId = $id;
            flash_set('Project updated successfully.');
        } else {
            $sql = "INSERT INTO projects (title, slug, card_image, intro_description, status)
                    VALUES (:title, :slug, :card_image, :idesc, :status)";
            $pdo->prepare($sql)->execute([
                ':title' => $title, ':slug' => $slug, ':card_image' => $cardImage,
                ':idesc' => $intro_description, ':status' => $status
            ]);
            $projectId = (int)$pdo->lastInsertId();
            flash_set('Project added successfully.');
        }

        // Save Goals
        $pdo->prepare("DELETE FROM project_goals WHERE project_id = :pid")->execute([':pid' => $projectId]);
        $stmtInsGoal = $pdo->prepare("INSERT INTO project_goals (project_id, goal_text, sort_order) VALUES (:pid, :gt, :so)");
        $order = 0;
        foreach ($submitted_goals as $gText) {
            $gText = trim($gText);
            if ($gText !== '') {
                $stmtInsGoal->execute([':pid' => $projectId, ':gt' => $gText, ':so' => $order++]);
            }
        }

        // Save Results
        $pdo->prepare("DELETE FROM project_results WHERE project_id = :pid")->execute([':pid' => $projectId]);
        $stmtInsRes = $pdo->prepare("INSERT INTO project_results (project_id, result_text, sort_order) VALUES (:pid, :rt, :so)");
        $order = 0;
        foreach ($submitted_results as $rText) {
            $rText = trim($rText);
            if ($rText !== '') {
                $stmtInsRes->execute([':pid' => $projectId, ':rt' => $rText, ':so' => $order++]);
            }
        }

        // Handle Gallery Images (Multiple uploads)
        if (!empty($_FILES['gallery_images']['name'][0])) {
            $targetDir = __DIR__ . '/uploads/projects/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            $stmtInsImg = $pdo->prepare("INSERT INTO project_images (project_id, image_path, sort_order) VALUES (:pid, :ip, :so)");
            $imgOrder = count($existing_images);

            foreach ($_FILES['gallery_images']['name'] as $key => $name) {
                if ($_FILES['gallery_images']['error'][$key] === UPLOAD_ERR_OK) {
                    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                    if (in_array($ext, $allowed)) {
                        $filename = uniqid('projects_gallery_', true) . '.' . $ext;
                        $destination = $targetDir . $filename;
                        if (move_uploaded_file($_FILES['gallery_images']['tmp_name'][$key], $destination)) {
                            $stmtInsImg->execute([
                                ':pid' => $projectId,
                                ':ip' => 'projects/' . $filename,
                                ':so' => $imgOrder++
                            ]);
                        }
                    }
                }
            }
        }

        header('Location: projects.php');
        exit;
    }

    $project = array_merge($project, compact('title', 'intro_description', 'status'));
}

$pageTitle  = $id ? 'Edit Project' : 'Add Project';
$activeMenu = 'project-add';
include __DIR__ . '/includes/header.php';
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.min.css" rel="stylesheet">

<?php foreach ($errors as $err): ?>
  <div class="alert error"><?= e($err) ?></div>
<?php endforeach; ?>

<form method="POST" enctype="multipart/form-data">
  <!-- Section 1: Basic Information -->
  <div class="form-section">
    <div class="form-section-head">
      <h3>Project Basic Info</h3>
      <p>Configure the title, showcase cover photo, and introduction paragraph for this project.</p>
    </div>

    <div class="form-grid-2">
      <div class="form-group">
        <label>Project Title <span class="req">*</span></label>
        <input type="text" name="title" value="<?= e($project['title']) ?>" required placeholder="e.g. BrightHome Energy Installation">
        <div class="hint">The name of the solar project or client installation.</div>
      </div>

      <div class="form-group">
        <label>Card & Hero Image</label>
        <input type="file" name="card_image" accept="image/*">
        <?php if (!empty($project['card_image'])): ?>
          <div class="current-image">
            <img src="<?= e(admin_image_url($project['card_image'])) ?>" alt="Current card image">
            <span class="meta">Current image uploaded</span>
          </div>
        <?php else: ?>
          <div class="hint">Recommended size: 800x500px (JPG, PNG, WebP)</div>
        <?php endif; ?>
      </div>
    </div>

    <div class="form-group full" style="margin-bottom:0;">
      <label>Intro Description</label>
      <div class="editor-wrap">
        <div id="intro_description_editor" class="editor editor-lg"><?= $project['intro_description'] ?></div>
      </div>
      <textarea name="intro_description" id="intro_description_input" style="display:none;"></textarea>
      <div class="hint">Overview of the project scope, context, and background.</div>
    </div>
  </div>

  <!-- Section 2: Client Goals -->
  <div class="form-section">
    <div class="form-section-head">
      <h3>Client Goals Checklist</h3>
      <p>List key goals and objectives the client wanted to achieve with this solar setup.</p>
    </div>

    <div class="repeatable-list" id="goals_list">
      <?php if (!empty($goals)): ?>
        <?php foreach ($goals as $g): ?>
          <div class="repeat-row">
            <input type="text" name="goals[]" value="<?= e($g) ?>" placeholder="e.g. Reduce energy cost by 40%">
            <button type="button" class="btn btn-outline btn-sm remove-row">&times;</button>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="repeat-row">
          <input type="text" name="goals[]" placeholder="e.g. Reduce energy cost by 40%">
          <button type="button" class="btn btn-outline btn-sm remove-row">&times;</button>
        </div>
      <?php endif; ?>
    </div>
    <button type="button" class="btn btn-outline btn-sm" data-repeat-add="goals_list" data-name="goals" data-placeholder="Enter client goal" style="margin-top:8px;">+ Add Goal Item</button>
  </div>

  <!-- Section 3: Impact & Results -->
  <div class="form-section">
    <div class="form-section-head">
      <h3>Impact & Results Checklist</h3>
      <p>Highlight measurable milestones and energy savings achieved after delivery.</p>
    </div>

    <div class="repeatable-list" id="results_list">
      <?php if (!empty($results)): ?>
        <?php foreach ($results as $r): ?>
          <div class="repeat-row">
            <input type="text" name="results[]" value="<?= e($r) ?>" placeholder="e.g. 500 kWh saved per month">
            <button type="button" class="btn btn-outline btn-sm remove-row">&times;</button>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="repeat-row">
          <input type="text" name="results[]" placeholder="e.g. 500 kWh saved per month">
          <button type="button" class="btn btn-outline btn-sm remove-row">&times;</button>
        </div>
      <?php endif; ?>
    </div>
    <button type="button" class="btn btn-outline btn-sm" data-repeat-add="results_list" data-name="results" data-placeholder="Enter impact or result" style="margin-top:8px;">+ Add Result Item</button>
  </div>

  <!-- Section 4: Gallery Photos -->
  <div class="form-section">
    <div class="form-section-head">
      <h3>Gallery Photos (Details Bottom Strip)</h3>
      <p>Upload multiple installation photos displayed in the bottom gallery grid.</p>
    </div>

    <div class="form-group">
      <label>Upload Gallery Photos</label>
      <input type="file" name="gallery_images[]" accept="image/*" multiple>
      <div class="hint">Hold Ctrl / Cmd to select multiple photos at once.</div>
    </div>

    <?php if (!empty($existing_images)): ?>
      <div class="form-group" style="margin-top:16px; margin-bottom:0;">
        <label>Current Gallery Photos (<?= count($existing_images) ?>)</label>
        <div class="gallery-strip">
          <?php foreach ($existing_images as $img): ?>
            <div style="position:relative; display:inline-block;">
              <img src="<?= e(admin_image_url($img['image_path'])) ?>" alt="Gallery Image">
              <a href="project-add.php?id=<?= $id ?>&delete_img=<?= $img['id'] ?>" class="btn btn-danger btn-sm confirm-delete" style="position:absolute; top:6px; right:6px; padding:3px 8px; font-size:12px; border-radius:4px;" title="Delete photo">&times;</a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <!-- Section 5: Publishing & Status -->
  <div class="form-section">
    <div class="form-section-head">
      <h3>Visibility & Publishing</h3>
      <p>Control whether this project is published publicly on the website.</p>
    </div>

    <div class="form-grid-2">
      <div class="form-group" style="margin-bottom:0;">
        <label>Publish Status</label>
        <select name="status">
          <option value="active" <?= $project['status']==='active'?'selected':'' ?>>Active (Visible on website)</option>
          <option value="inactive" <?= $project['status']==='inactive'?'selected':'' ?>>Inactive (Draft / Hidden)</option>
        </select>
      </div>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn-accent"><?= $id ? 'Update Project' : 'Save Project' ?></button>
      <a href="projects.php" class="btn btn-outline">Cancel</a>
    </div>
  </div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.min.js"></script>
<script>
  var toolbarOptions = [
    [{ 'header': [1, 2, 3, false] }],
    ['bold', 'italic', 'underline', 'strike'],
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    ['link', 'clean']
  ];
  var quill = new Quill('#intro_description_editor', {
    theme: 'snow',
    modules: { toolbar: toolbarOptions }
  });
  var input = document.getElementById('intro_description_input');
  quill.on('text-change', function () {
    input.value = quill.root.innerHTML;
  });
  input.value = quill.root.innerHTML;
  document.querySelector('form').addEventListener('submit', function () {
    input.value = quill.root.innerHTML;
  });
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
