<?php
/**
 * Database Connection & Data Access Layer for Public Website
 * Connects to the same MySQL database as the Admin panel.
 */

if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'ak_energies');
    define('DB_USER', 'root');
    define('DB_PASS', '');
}

function get_db() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );
        } catch (PDOException $e) {
            error_log('Database connection failed in includes/db.php: ' . $e->getMessage());
            return null;
        }
    }
    return $pdo;
}

/**
 * Resolve an image path for frontend display.
 * Supports uploads stored in admin/uploads/ or static images in images/.
 */
function get_image_url($path, $fallback = 'images/misc/main-1.jpg') {
    if (empty($path)) {
        return $fallback;
    }
    // If it is already a full URL or relative path
    if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
        return $path;
    }
    // If file exists under admin/uploads/
    if (file_exists(__DIR__ . '/../admin/uploads/' . $path)) {
        return 'admin/uploads/' . $path;
    }
    // If file exists under root
    if (file_exists(__DIR__ . '/../' . $path)) {
        return $path;
    }
    return $path;
}

/**
 * Fetch active services ordered by sort_order and ID.
 */
function get_active_services($limit = null) {
    $db = get_db();
    if (!$db) return [];
    try {
        $sql = "SELECT * FROM services WHERE status = 'active' ORDER BY sort_order ASC, id ASC";
        if ($limit !== null) {
            $sql .= " LIMIT " . (int)$limit;
        }
        return $db->query($sql)->fetchAll();
    } catch (Exception $e) {
        error_log('get_active_services error: ' . $e->getMessage());
        return [];
    }
}

/**
 * Fetch a single service by slug or numeric ID.
 */
function get_service_by_slug_or_id($param) {
    $db = get_db();
    if (!$db || empty($param)) return null;
    try {
        if (is_numeric($param)) {
            $stmt = $db->prepare("SELECT * FROM services WHERE id = :id AND status = 'active' LIMIT 1");
            $stmt->execute([':id' => (int)$param]);
        } else {
            $stmt = $db->prepare("SELECT * FROM services WHERE slug = :slug AND status = 'active' LIMIT 1");
            $stmt->execute([':slug' => trim($param)]);
        }
        $service = $stmt->fetch();
        if (!$service && is_numeric($param)) {
            $stmt = $db->prepare("SELECT * FROM services WHERE id = :id LIMIT 1");
            $stmt->execute([':id' => (int)$param]);
            $service = $stmt->fetch();
        }
        return $service ?: null;
    } catch (Exception $e) {
        error_log('get_service_by_slug_or_id error: ' . $e->getMessage());
        return null;
    }
}

/**
 * Fetch active projects ordered by sort_order and ID.
 */
function get_active_projects($limit = null) {
    $db = get_db();
    if (!$db) return [];
    try {
        $sql = "SELECT * FROM projects WHERE status = 'active' ORDER BY sort_order ASC, id ASC";
        if ($limit !== null) {
            $sql .= " LIMIT " . (int)$limit;
        }
        return $db->query($sql)->fetchAll();
    } catch (Exception $e) {
        error_log('get_active_projects error: ' . $e->getMessage());
        return [];
    }
}

/**
 * Fetch a single project by slug or numeric ID with goals, results, and gallery photos.
 */
function get_project_by_slug_or_id($param) {
    $db = get_db();
    if (!$db || empty($param)) return null;
    try {
        if (is_numeric($param)) {
            $stmt = $db->prepare("SELECT * FROM projects WHERE id = :id AND status = 'active' LIMIT 1");
            $stmt->execute([':id' => (int)$param]);
        } else {
            $stmt = $db->prepare("SELECT * FROM projects WHERE slug = :slug AND status = 'active' LIMIT 1");
            $stmt->execute([':slug' => trim($param)]);
        }
        $project = $stmt->fetch();
        if (!$project && is_numeric($param)) {
            $stmt = $db->prepare("SELECT * FROM projects WHERE id = :id LIMIT 1");
            $stmt->execute([':id' => (int)$param]);
            $project = $stmt->fetch();
        }
        if (!$project) return null;

        $pid = (int)$project['id'];

        // Goals
        $stmtG = $db->prepare("SELECT goal_text FROM project_goals WHERE project_id = :pid ORDER BY sort_order ASC, id ASC");
        $stmtG->execute([':pid' => $pid]);
        $project['goals'] = $stmtG->fetchAll(PDO::FETCH_COLUMN);

        // Results
        $stmtR = $db->prepare("SELECT result_text FROM project_results WHERE project_id = :pid ORDER BY sort_order ASC, id ASC");
        $stmtR->execute([':pid' => $pid]);
        $project['results'] = $stmtR->fetchAll(PDO::FETCH_COLUMN);

        // Gallery
        $stmtI = $db->prepare("SELECT image_path FROM project_images WHERE project_id = :pid ORDER BY sort_order ASC, id ASC");
        $stmtI->execute([':pid' => $pid]);
        $project['gallery'] = $stmtI->fetchAll(PDO::FETCH_COLUMN);

        return $project;
    } catch (Exception $e) {
        error_log('get_project_by_slug_or_id error: ' . $e->getMessage());
        return null;
    }
}

/**
 * Save customer enquiry from contact form into database.
 */
function save_enquiry($name, $email, $phone = '', $service = 'General Quote', $message = '') {
    $db = get_db();
    if (!$db) return false;
    try {
        $stmt = $db->prepare("INSERT INTO enquiries (name, email, phone, service_interested, message, status) VALUES (:name, :email, :phone, :service, :message, 'new')");
        return $stmt->execute([
            ':name'    => trim($name),
            ':email'   => trim($email),
            ':phone'   => trim($phone),
            ':service' => trim($service),
            ':message' => trim($message),
        ]);
    } catch (Exception $e) {
        error_log('save_enquiry error: ' . $e->getMessage());
        return false;
    }
}
