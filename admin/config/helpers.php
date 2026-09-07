<?php
/**
 * Small shared helper functions used across the admin pages.
 */

function e($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = trim($text, '-');
    $text = strtolower($text);
    $text = preg_replace('~[^-a-z0-9]+~', '', $text);
    return $text ?: 'item-' . time();
}

function unique_slug($pdo, $table, $baseSlug, $ignoreId = null) {
    $slug = slugify($baseSlug);
    $original = $slug;
    $i = 1;
    while (true) {
        $sql = "SELECT id FROM `$table` WHERE slug = :slug";
        if ($ignoreId) $sql .= " AND id != :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':slug', $slug);
        if ($ignoreId) $stmt->bindValue(':id', $ignoreId);
        $stmt->execute();
        if (!$stmt->fetch()) break;
        $slug = $original . '-' . $i;
        $i++;
    }
    return $slug;
}

/**
 * Handle a single uploaded image. Returns the stored filename (with subfolder)
 * or null if no new file was uploaded / on failure.
 */
function handle_upload($fieldName, $subfolder) {
    if (empty($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] === UPLOAD_ERR_NO_FILE) {
        return null;
    }
    if ($_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $ext = strtolower(pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) {
        return null;
    }

    $targetDir = __DIR__ . '/../uploads/' . $subfolder . '/';
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $filename = uniqid($subfolder . '_', true) . '.' . $ext;
    $destination = $targetDir . $filename;

    if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $destination)) {
        return $subfolder . '/' . $filename;
    }
    return null;
}

function flash_set($message, $type = 'success') {
    $_SESSION['flash'] = ['message' => $message, 'type' => $type];
}

function flash_get() {
    if (!empty($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

/**
 * Resolve an image path for admin view.
 * Supports uploads stored in admin/uploads/ or static images in ../images/.
 */
function admin_image_url($path, $fallback = 'https://placehold.co/120x80?text=No+Img') {
    if (empty($path)) {
        return $fallback;
    }
    if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
        return $path;
    }
    $cleanPath = ltrim($path, '/\\');

    // Case 1: If path already begins with uploads/
    if (strpos($cleanPath, 'uploads/') === 0) {
        $sub = substr($cleanPath, 8);
        if (file_exists(__DIR__ . '/../uploads/' . $sub)) {
            return 'uploads/' . $sub;
        }
    }
    // Case 2: File exists directly in admin/uploads/
    if (file_exists(__DIR__ . '/../uploads/' . $cleanPath)) {
        return 'uploads/' . $cleanPath;
    }
    // Case 3: File exists in root folder (e.g. images/projects/...)
    if (file_exists(__DIR__ . '/../../' . $cleanPath)) {
        return '../' . $cleanPath;
    }
    // Case 4: Check subfolders in uploads
    $base = basename($cleanPath);
    if (file_exists(__DIR__ . '/../uploads/services/' . $base)) {
        return 'uploads/services/' . $base;
    }
    if (file_exists(__DIR__ . '/../uploads/projects/' . $base)) {
        return 'uploads/projects/' . $base;
    }

    return '../' . $cleanPath;
}
