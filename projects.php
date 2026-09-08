<?php
require_once __DIR__ . '/includes/db.php';

$page_title = "Projects - AK Energies";
$page_description = "Explore our latest successful solar installations and clean energy projects.";
$current_page = "projects";
$extra_scripts = [
    'js/custom-swiper-1.js',
    'js/custom-marquee.js'
];
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/header.php';

$projects = get_active_projects();
?>

<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <section id="subheader" class="bg-dark text-light relative jarallax">
        <img src="images/background/3.webp" class="jarallax-img" alt="">
        <div class="container relative z-2">
            <div class="row gy-4 gx-5 align-items-center">
                <div class="col-lg-12">
                    <div class="spacer-double sm-hide"></div>
                    <h5 class="wow fadeInUp">Power Your Future with Clean Energy</h5>
                    <h1 class="mb-3 wow fadeInUp" data-wow-delay=".2s">Our Projects</h1>
                    <div class="border-bottom mb-3"></div>
                    <ul class="crumb wow fadeInUp">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Our Projects</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="gradient-edge-bottom h-50"></div>
        <div class="sw-overlay"></div>
    </section>

    <section>
        <div class="container">
            <div class="row g-4">
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $p): 
                        $card_img = get_image_url($p['card_image'], 'images/projects/1.webp');
                        $link = 'project-single.php?id=' . urlencode($p['slug']);
                        $excerpt = strip_tags($p['intro_description']);
                        if (mb_strlen($excerpt) > 90) {
                            $excerpt = mb_substr($excerpt, 0, 90) . '...';
                        }
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <a href="<?= htmlspecialchars($link) ?>">
                            <div class="hover rounded-1 relative overflow-hidden text-light">
                                <div class="abs p-40 top-0 z-3">
                                    <img src="images/misc/up-right-arrow-white.webp" class="w-10 mb-3 wow scaleIn" alt="" aria-hidden="true">
                                </div>
                                <div class="abs p-40 bottom-0 z-3">
                                    <h3><?= htmlspecialchars($p['title']) ?></h3>
                                    <p class="mb-0 hover-mh-60"><?= htmlspecialchars($excerpt) ?></p>
                                </div>
                                <div class="hover-op-05 bg-dark abs w-100 h-100 top-0 start-0 z-2"></div>
                                <img src="<?= htmlspecialchars($card_img) ?>" class="w-100 hover-scale-1-2" style="height: 440px; object-fit: cover;" alt="<?= htmlspecialchars($p['title']) ?>">
                                <div class="gradient-edge-bottom h-50"></div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5">
                        <p class="lead text-muted">No projects found. Check back soon.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="bg-dark text-light relative jarallax overflow-hidden py-5">
        <img src="images/background/gradient-2.webp" class="jarallax-img" alt="">
        <div class="container relative z-2">
            <div class="row g-4 align-items-center justify-content-between">
                <div class="col-lg-7">
                    <div class="subtitle id-color wow fadeInUp mb-2">HAVE A SOLAR PROJECT IN MIND?</div>
                    <h2 class="text-white wow fadeInUp" data-wow-delay=".2s">Let's Build Your Renewable Energy System</h2>
                    <p class="fs-16 text-white-50 mb-0 wow fadeInUp" data-wow-delay=".3s">
                        Our expert engineering team is ready to design and deliver high-yield solar solutions for your property.
                    </p>
                </div>
                <div class="col-lg-5 text-lg-end wow fadeInUp" data-wow-delay=".4s">
                    <div class="d-flex flex-wrap gap-3 justify-content-lg-end">
                        <a href="contact.php" class="btn-main fx-slide">
                            <span>START YOUR PROJECT</span>
                        </a>
                        <a href="https://wa.me/1800987654?text=Hi%20AK%20Energies%2C%20I%20have%20a%20solar%20project%20in%20mind" target="_blank" rel="noopener noreferrer" class="btn-main btn-line fx-slide hover-white">
                            <span><i class="fa-brands fa-whatsapp me-1 text-success"></i> DISCUSS ON WHATSAPP</span>
                        </a>
                    </div>
                </div>
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