<?php
require_once __DIR__ . '/includes/db.php';

$page_title = "Our Services - AK Energies";
$page_description = "Explore our comprehensive solar energy and power system services.";
$current_page = "services";
$extra_scripts = [
    'js/custom-swiper-1.js',
    'js/custom-marquee.js'
];
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/header.php';

$services = get_active_services();
?>

        <!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>

            <section id="subheader" class="bg-dark text-light relative jarallax">
                <img src="images/background/w2.webp" class="jarallax-img" alt="">
                <div class="container relative z-2">
                    <div class="row gy-4 gx-5 align-items-center">
                        <div class="col-lg-12">
                            <div class="spacer-double sm-hide"></div>
                            <h5 class="wow fadeInUp">Power Your Future with Clean Energy</h5>
                            <h1 class="mb-3 wow fadeInUp" data-wow-delay=".2s">Our Services</h1>
                            <div class="border-bottom mb-3"></div>
                            <ul class="crumb wow fadeInUp">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Our Services</li>
                            </ul>   
                        </div>
                    </div>
                </div>

                <div class="gradient-edge-bottom h-50"></div>
                <div class="sw-overlay"></div>
            </section>
             
            <section>
                <div class="container">
                    <div class="row g-4 justify-content-center">
                        <div class="col-lg-8 text-center">
                            <div class="subtitle wow fadeInUp mb-3">SOLAR ENERGY SERVICES</div>
                            <h2 class="wow fadeInUp" data-wow-delay=".2s">Complete Solar Energy <span class="op-3">Solutions</span></h2>
                            <p class="lead mb-0 wow fadeInUp">At <strong>AK ENERGIES</strong>, we provide reliable and customized solar energy solutions for residential, commercial, industrial, and institutional requirements. Our services cover the complete project lifecycle, from planning and engineering to installation, commissioning, and ongoing support.</p>
                            <div class="spacer-single"></div>
                            <div class="spacer-half"></div>
                        </div>
                    </div>

                    <div class="row g-4">
                        <?php if (!empty($services)): ?>
                            <?php foreach ($services as $s): 
                                $card_img = get_image_url($s['card_image'], 'images/services/rooftop-solar-tn.jpg');
                                $link = 'service-single.php?id=' . urlencode($s['slug']);
                            ?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="hover">
                                    <div class="relative overflow-hidden">
                                        <a href="<?= htmlspecialchars($link) ?>" class="d-block hover">
                                            <div class="relative overflow-hidden rounded-1">
                                                <img src="<?= htmlspecialchars($card_img) ?>" class="w-100 hover-scale-1-2" style="height: 280px; object-fit: cover;" alt="<?= htmlspecialchars($s['title']) ?>">
                                            </div>
                                        </a>
                                        <div class="p-30 relative bg-white rounded-1 mx-4 mt-min-100 shadow-sm" style="min-height: 200px;">
                                            <div class="abs top-0 end-0 mt-min-30 me-4 circle bg-color w-60px h-60px">
                                                <a href="<?= htmlspecialchars($link) ?>" aria-label="Learn more about <?= htmlspecialchars($s['title']) ?>">
                                                    <img src="images/misc/up-right-arrow-white.webp" class="w-60px p-20" alt="" aria-hidden="true">
                                                </a>
                                            </div>
                                            <h4><a href="<?= htmlspecialchars($link) ?>" class="text-dark text-decoration-none"><?= htmlspecialchars($s['title']) ?></a></h4>
                                            <p class="mb-0"><?= htmlspecialchars(strip_tags($s['short_description'])) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12 text-center py-5">
                                <p class="lead text-muted">No services available at the moment. Please check back soon.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <!-- Common CTA Section for All Service Pages -->
            <section class="bg-dark text-light relative jarallax overflow-hidden py-5">
                <img src="images/background/gradient-2.webp" class="jarallax-img" alt="">
                <div class="container relative z-2">
                    <div class="row g-4 align-items-center justify-content-between">
                        <div class="col-lg-7">
                            <div class="subtitle id-color wow fadeInUp mb-2">POWER YOUR TOMORROW</div>
                            <h2 class="text-white wow fadeInUp" data-wow-delay=".2s">Ready to Power Your Future with Solar Energy?</h2>
                            <p class="fs-16 text-white-50 mb-0 wow fadeInUp" data-wow-delay=".3s">
                                Talk to <strong>AK ENERGIES</strong> about your project requirements and discover the right renewable energy solution for your needs.
                            </p>
                        </div>
                        <div class="col-lg-5 text-lg-end wow fadeInUp" data-wow-delay=".4s">
                            <div class="d-flex flex-wrap gap-3 justify-content-lg-end">
                                <a href="contact.php" class="btn-main fx-slide">
                                    <span>GET A FREE QUOTE</span>
                                </a>
                                <a href="https://wa.me/1800987654?text=Hi%20AK%20Energies%2C%20I%20would%20like%20to%20know%20more%20about%20your%20solar%20services" target="_blank" rel="noopener noreferrer" class="btn-main btn-line fx-slide hover-white">
                                    <span><i class="fa-brands fa-whatsapp me-1 text-success"></i> CHAT ON WHATSAPP</span>
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
