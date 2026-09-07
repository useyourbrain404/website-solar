<?php
require_once __DIR__ . '/includes/db.php';

$param = $_GET['id'] ?? 'brighthome-energy';
$project = get_project_by_slug_or_id($param);

// If not found, try getting the first available active project
if (!$project) {
    $all_projects = get_active_projects(1);
    if (!empty($all_projects)) {
        $project = get_project_by_slug_or_id($all_projects[0]['id']);
    }
}

// Fallback safety
if (!$project) {
    $project = [
        'id' => 1,
        'title' => 'BrightHome Energy – Residential Solar Panel Installation',
        'slug'  => 'brighthome-energy',
        'card_image' => 'images/projects/1.webp',
        'intro_description' => '<p>BrightHome Energy successfully completed the installation of a full-scale residential solar panel system on a modern sloped-roof home.</p>',
        'goals' => [
            'Reduce monthly electricity bills',
            'Transition to renewable energy',
            'Increase property value',
            'Gain energy independence with minimal maintenance'
        ],
        'results' => [
            '60% electricity cost reduction',
            '5.2 tons CO2 offset annually',
            'Energy self-sufficiency',
            'Increased home resale value'
        ],
        'gallery' => [
            'images/projects/1.webp',
            'images/projects/pro-2.jpg',
            'images/projects/2.webp'
        ]
    ];
}

$page_title = htmlspecialchars($project['title']) . " - AK Energies";
$page_description = htmlspecialchars(strip_tags($project['intro_description']));
$current_page = "project-single";
$extra_scripts = [
    'js/custom-swiper-1.js',
    'js/custom-marquee.js'
];
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/header.php';

$hero_img = get_image_url($project['card_image'], 'images/projects/1.webp');
?>

<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <section id="subheader" class="bg-dark text-light relative jarallax">
        <img src="images/background/5.webp" class="jarallax-img" alt="<?= htmlspecialchars($project['title']); ?>">
        <div class="container relative z-2">
            <div class="row gy-4 gx-5 align-items-center">
                <div class="col-lg-12">
                    <div class="spacer-double sm-hide"></div>
                    <h2 class="mb-3 wow fadeInUp" data-wow-delay=".2s"><?= htmlspecialchars($project['title']); ?></h2>
                    <div class="border-bottom mb-3"></div>
                    <ul class="crumb wow fadeInUp">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="projects.php">Projects</a></li>
                        <li class="active"><?= htmlspecialchars($project['title']); ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="gradient-edge-bottom h-50"></div>
        <div class="sw-overlay"></div>
    </section>

    <section>
        <div class="container">
            <!-- Project Main Photo -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <div class="rounded-1 overflow-hidden shadow-sm">
                        <img src="<?= htmlspecialchars($hero_img); ?>" class="w-100" style="max-height: 480px; object-fit: cover;" alt="<?= htmlspecialchars($project['title']); ?>">
                    </div>
                </div>
            </div>

            <!-- Project Intro & Overview -->
            <div class="row g-4 mb-4">
                <div class="col-md-12">
                    <div class="fs-18 fw-500 lh-1-7 wow fadeInUp text-dark p-4 bg-light rounded-1 border-start border-4 border-primary">
                        <?= $project['intro_description']; ?>
                    </div>
                </div>
            </div>

            <div class="spacer-single"></div>

            <!-- Goals and Results Columns -->
            <div class="row g-4">
                <div class="col-md-6 wow fadeInUp" data-wow-delay=".0s">
                    <h3 class="mb-3"><i class="fa fa-bullseye text-blue me-2"></i> Client Goals</h3>
                    <?php if (!empty($project['goals'])): ?>
                        <ul class="ul-check text-dark">
                            <?php foreach ($project['goals'] as $g): ?>
                                <li><?= htmlspecialchars($g); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">High performance clean power generation and reduced operational utility expenses.</p>
                    <?php endif; ?>
                </div>

                <div class="col-md-6 wow fadeInUp" data-wow-delay=".2s">
                    <h3 class="mb-3"><i class="fa fa-chart-line text-blue me-2"></i> Impact & Results</h3>
                    <?php if (!empty($project['results'])): ?>
                        <ul class="ul-check text-dark">
                            <?php foreach ($project['results'] as $r): ?>
                                <li><?= htmlspecialchars($r); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">Measurable reduction in carbon footprint with reliable round-the-clock solar yield.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Project Gallery Carousel -->
            <?php if (!empty($project['gallery'])): ?>
                <div class="spacer-double"></div>
                <div class="row g-4">
                    <div class="col-lg-12 wow fadeInUp">
                        <h3 class="mb-3"><i class="fa fa-images text-blue me-2"></i> Project Gallery</h3>
                        <div class="overflow-hidden rounded-1">
                            <div class="relative wow fadeIn">
                                <div class="owl-custom-nav menu-float" data-target="#project-single-carousel">
                                    <a class="btn-next"></a>
                                    <a class="btn-prev"></a>

                                    <div id="project-single-carousel" class="owl-2-cols-center owl-carousel owl-theme">
                                        <?php foreach ($project['gallery'] as $gImg): 
                                            $gUrl = get_image_url($gImg, 'images/projects/1.webp');
                                        ?>
                                        <div class="item">
                                            <div class="hover relative rounded-1 overflow-hidden text-light">
                                                <img src="<?= htmlspecialchars($gUrl); ?>" class="w-100" style="height: 320px; object-fit: cover;" alt="Project Visual">
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="text-center mt-5">
                <a href="projects.php" class="btn-main btn-line fx-slide me-3"><span>&larr; BACK TO ALL PROJECTS</span></a>
                <a href="contact.php" class="btn-main fx-slide"><span>REQUEST SIMILAR INSTALLATION</span></a>
            </div>

        </div>
    </section>

    <?php require_once __DIR__ . '/includes/prefooter.php'; ?>
</div>
<!-- content end -->

<?php
require_once __DIR__ . '/includes/footer.php';
require_once __DIR__ . '/includes/scripts.php';
?>