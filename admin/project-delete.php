<?php
require_once __DIR__ . '/config/auth.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/helpers.php';
require_login();

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($id) {
    // Delete main image if exists
    $stmt = $pdo->prepare("SELECT card_image FROM projects WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $proj = $stmt->fetch();
    if ($proj && !empty($proj['card_image'])) {
        @unlink(__DIR__ . '/uploads/' . $proj['card_image']);
    }

    // Delete gallery images if exist
    $stmtG = $pdo->prepare("SELECT image_path FROM project_images WHERE project_id = :id");
    $stmtG->execute([':id' => $id]);
    $gImgs = $stmtG->fetchAll(PDO::FETCH_COLUMN);
    foreach ($gImgs as $gImg) {
        @unlink(__DIR__ . '/uploads/' . $gImg);
    }

    // Foreign key CASCADE will automatically delete project_goals, project_results, and project_images records
    $stmtDel = $pdo->prepare("DELETE FROM projects WHERE id = :id");
    $stmtDel->execute([':id' => $id]);

    flash_set('Project deleted successfully.');
}

header('Location: projects.php');
exit;
