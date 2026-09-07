<?php
require_once __DIR__ . '/config/auth.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/helpers.php';
require_login();

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($id) {
    $stmt = $pdo->prepare("SELECT card_image, detail_image1, detail_image2 FROM services WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $srv = $stmt->fetch();
    if ($srv) {
        if (!empty($srv['card_image'])) @unlink(__DIR__ . '/uploads/' . $srv['card_image']);
        if (!empty($srv['detail_image1'])) @unlink(__DIR__ . '/uploads/' . $srv['detail_image1']);
        if (!empty($srv['detail_image2'])) @unlink(__DIR__ . '/uploads/' . $srv['detail_image2']);
    }

    $pdo->prepare("DELETE FROM services WHERE id = :id")->execute([':id' => $id]);
    flash_set('Service deleted successfully.');
}

header('Location: services.php');
exit;
