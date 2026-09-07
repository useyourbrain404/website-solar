<?php
require_once __DIR__ . '/config/auth.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/helpers.php';
require_login();

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$service = [
    'title' => '', 'short_description' => '', 'card_image' => '',
    'tag_label' => '', 'heading' => '', 'long_description' => '',
    'detail_image1' => '', 'detail_image2' => '', 'status' => 'active',
];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $found = $stmt->fetch();
    if (!$found) {
        flash_set('Service not found.', 'error');
        header('Location: services.php');
        exit;
    }
    $service = $found;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title             = trim($_POST['title'] ?? '');
    $short_description = $_POST['short_description'] ?? '';
    $tag_label         = trim($_POST['tag_label'] ?? '');
    $heading           = trim($_POST['heading'] ?? '');
    $long_description  = $_POST['long_description'] ?? '';
    $status            = ($_POST['status'] ?? 'active') === 'inactive' ? 'inactive' : 'active';

    if ($title === '') {
        $errors[] = 'Service Title is required.';
    }

    if (!$errors) {
        $slug = unique_slug($pdo, 'services', $title, $id);

        $cardImage    = handle_upload('card_image', 'services');
        $detailImage1 = handle_upload('detail_image1', 'services');
        $detailImage2 = handle_upload('detail_image2', 'services');

        if ($id) {
            $sql = "UPDATE services SET title=:title, slug=:slug, short_description=:sd,
                    tag_label=:tag, heading=:heading, long_description=:ld, status=:status
                    " . ($cardImage ? ", card_image=:card_image" : "") . "
                    " . ($detailImage1 ? ", detail_image1=:d1" : "") . "
                    " . ($detailImage2 ? ", detail_image2=:d2" : "") . "
                    WHERE id=:id";
            $params = [
                ':title' => $title, ':slug' => $slug, ':sd' => $short_description,
                ':tag' => $tag_label, ':heading' => $heading, ':ld' => $long_description,
                ':status' => $status, ':id' => $id,
            ];
            if ($cardImage) $params[':card_image'] = $cardImage;
            if ($detailImage1) $params[':d1'] = $detailImage1;
            if ($detailImage2) $params[':d2'] = $detailImage2;

            $pdo->prepare($sql)->execute($params);
            flash_set('Service updated successfully.');
        } else {
            $sql = "INSERT INTO services
                    (title, slug, short_description, card_image, tag_label, heading, long_description, detail_image1, detail_image2, status)
                    VALUES (:title, :slug, :sd, :card_image, :tag, :heading, :ld, :d1, :d2, :status)";
            $pdo->prepare($sql)->execute([
                ':title' => $title, ':slug' => $slug, ':sd' => $short_description,
                ':card_image' => $cardImage, ':tag' => $tag_label, ':heading' => $heading,
                ':ld' => $long_description, ':d1' => $detailImage1, ':d2' => $detailImage2,
                ':status' => $status,
            ]);
            flash_set('Service added successfully.');
        }
        header('Location: services.php');
        exit;
    }

    // repopulate on error
    $service = array_merge($service, compact('title', 'short_description', 'tag_label', 'heading', 'long_description', 'status'));
}

$pageTitle  = $id ? 'Edit Service' : 'Add Service';
$activeMenu = 'service-add';
include __DIR__ . '/includes/header.php';
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.min.css" rel="stylesheet">

<?php foreach ($errors as $err): ?>
  <div class="alert error"><?= e($err) ?></div>
<?php endforeach; ?>

<form method="POST" enctype="multipart/form-data">
  <!-- Section 1: Listing Card Info -->
  <div class="form-section">
    <div class="form-section-head">
      <h3>Service Card (Listing Overview)</h3>
      <p>Configure the title, card thumbnail, and brief summary shown on the main services page.</p>
    </div>

    <div class="form-grid-2">
      <div class="form-group">
        <label>Service Title <span class="req">*</span></label>
        <input type="text" name="title" value="<?= e($service['title']) ?>" required placeholder="e.g. Solar Panel Installation">
        <div class="hint">The main headline for this service.</div>
      </div>

      <div class="form-group">
        <label>Card Thumbnail Image</label>
        <input type="file" name="card_image" accept="image/*">
        <?php if (!empty($service['card_image'])): ?>
          <div class="current-image">
            <img src="<?= e(admin_image_url($service['card_image'])) ?>" alt="Current card image">
            <span class="meta">Current image uploaded</span>
          </div>
        <?php else: ?>
          <div class="hint">Recommended size: 600x400px (JPG, PNG, WebP)</div>
        <?php endif; ?>
      </div>
    </div>

    <div class="form-group full" style="margin-bottom:0;">
      <label>Short Description (Card Summary)</label>
      <div class="editor-wrap">
        <div id="short_description_editor" class="editor editor-sm"><?= $service['short_description'] ?></div>
      </div>
      <textarea name="short_description" id="short_description_input" style="display:none;"></textarea>
      <div class="hint">A brief 1-2 sentence excerpt that appears under the title on cards.</div>
    </div>
  </div>

  <!-- Section 2: Details Page Content -->
  <div class="form-section">
    <div class="form-section-head">
      <h3>Service Details Page Content</h3>
      <p>Configure the detailed information and gallery visuals displayed on the service page.</p>
    </div>

    <div class="form-grid-2">
      <div class="form-group">
        <label>Tag Label</label>
        <input type="text" name="tag_label" value="<?= e($service['tag_label']) ?>" placeholder="e.g. PROFESSIONAL WORKERS">
        <div class="hint">Small uppercase sub-badge shown above the heading.</div>
      </div>

      <div class="form-group">
        <label>Detail Main Heading</label>
        <input type="text" name="heading" value="<?= e($service['heading']) ?>" placeholder="e.g. Expert Solar Installation">
        <div class="hint">The prominent heading on the detail page.</div>
      </div>
    </div>

    <div class="form-grid-2">
      <div class="form-group">
        <label>Detail Image 1 (Large Photo)</label>
        <input type="file" name="detail_image1" accept="image/*">
        <?php if (!empty($service['detail_image1'])): ?>
          <div class="current-image">
            <img src="<?= e(admin_image_url($service['detail_image1'])) ?>" alt="Detail photo 1">
            <span class="meta">Current photo 1 uploaded</span>
          </div>
        <?php else: ?>
          <div class="hint">Primary hero image for the service article.</div>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label>Detail Image 2 (Overlapping Photo)</label>
        <input type="file" name="detail_image2" accept="image/*">
        <?php if (!empty($service['detail_image2'])): ?>
          <div class="current-image">
            <img src="<?= e(admin_image_url($service['detail_image2'])) ?>" alt="Detail photo 2">
            <span class="meta">Current photo 2 uploaded</span>
          </div>
        <?php else: ?>
          <div class="hint">Secondary accent image.</div>
        <?php endif; ?>
      </div>
    </div>

    <div class="form-group full" style="margin-bottom:0;">
      <label>Long Description (Full Body Content)</label>
      <div class="editor-wrap">
        <div id="long_description_editor" class="editor editor-lg"><?= $service['long_description'] ?></div>
      </div>
      <textarea name="long_description" id="long_description_input" style="display:none;"></textarea>
      <div class="hint">Comprehensive overview, specifications, and benefits of the service.</div>
    </div>
  </div>

  <!-- Section 3: Publishing & Visibility -->
  <div class="form-section">
    <div class="form-section-head">
      <h3>Visibility & Publishing</h3>
      <p>Choose whether this service is published or saved as a draft.</p>
    </div>

    <div class="form-grid-2">
      <div class="form-group" style="margin-bottom:0;">
        <label>Publish Status</label>
        <select name="status">
          <option value="active" <?= $service['status']==='active'?'selected':'' ?>>Active (Visible on website)</option>
          <option value="inactive" <?= $service['status']==='inactive'?'selected':'' ?>>Inactive (Draft / Hidden)</option>
        </select>
      </div>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn-accent"><?= $id ? 'Update Service' : 'Save Service' ?></button>
      <a href="services.php" class="btn btn-outline">Cancel</a>
    </div>
  </div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.min.js"></script>
<script>
  function initEditor(editorId, inputId) {
    var toolbarOptions = [
      [{ 'header': [1, 2, 3, false] }],
      ['bold', 'italic', 'underline', 'strike'],
      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
      ['link', 'clean']
    ];
    var quill = new Quill('#' + editorId, {
      theme: 'snow',
      modules: { toolbar: toolbarOptions }
    });
    var input = document.getElementById(inputId);
    quill.on('text-change', function () {
      input.value = quill.root.innerHTML;
    });
    input.value = quill.root.innerHTML;
    document.querySelector('form').addEventListener('submit', function () {
      input.value = quill.root.innerHTML;
    });
  }

  initEditor('short_description_editor', 'short_description_input');
  initEditor('long_description_editor', 'long_description_input');
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
