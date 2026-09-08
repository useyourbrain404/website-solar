<?php
require_once __DIR__ . '/includes/db.php';

$param = $_GET['id'] ?? 'solar-rooftop-systems';
$service = get_service_by_slug_or_id($param);

// If not found, try getting the first available active service
if (!$service) {
    $all_services = get_active_services(1);
    if (!empty($all_services)) {
        $service = $all_services[0];
    }
}

// Fallback safety if database is completely empty
if (!$service) {
    $service = [
        'id' => 1,
        'title' => 'Solar Rooftop Systems',
        'slug' => 'solar-rooftop-systems',
        'short_description' => 'Turn your unused rooftop space into a reliable source of clean energy with customized solar solutions from AK ENERGIES.',
        'tag_label' => 'RESIDENTIAL & COMMERCIAL',
        'heading' => 'Customized Solar Rooftop Installations',
        'long_description' => '<p>Turn your unused rooftop space into a reliable source of clean energy with customized solar solutions from AK ENERGIES. We design and install efficient rooftop systems for homes, businesses, industries, and institutions.</p>',
        'card_image' => 'images/services/rooftop-solar-tn.jpg',
        'detail_image1' => 'images/services/rooftop-solar-tn.jpg',
        'detail_image2' => 'images/services/ro-1.jpg',
    ];
}

$all_services = get_active_services();

$page_title = htmlspecialchars($service['title']) . " - AK Energies";
$page_description = htmlspecialchars(strip_tags($service['short_description']));
$current_page = "services";
$extra_scripts = [
    'js/custom-swiper-1.js',
    'js/custom-marquee.js'
];
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/header.php';

$hero_img = get_image_url($service['card_image'], 'images/services/rooftop-solar-tn.jpg');
$detail_img1 = !empty($service['detail_image1']) ? get_image_url($service['detail_image1']) : '';
$detail_img2 = !empty($service['detail_image2']) ? get_image_url($service['detail_image2']) : '';
?>

<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <!-- Subheader Parallax Banner -->
    <section id="subheader" class="bg-dark text-light relative jarallax">
        <img src="images/background/w2.webp" class="jarallax-img" alt="<?= htmlspecialchars($service['title']); ?>">
        <div class="container relative z-2">
            <div class="row gy-4 gx-5 align-items-center">
                <div class="col-lg-12">
                    <div class="spacer-double sm-hide"></div>
                    <h5 class="wow fadeInUp text-blue fw-600"><?= !empty($service['tag_label']) ? htmlspecialchars($service['tag_label']) : 'SOLAR SERVICE'; ?> — AK ENERGIES</h5>
                    <h1 class="mb-3 wow fadeInUp" data-wow-delay=".2s"><?= htmlspecialchars($service['title']); ?></h1>
                    <div class="border-bottom mb-3"></div>
                    <ul class="crumb wow fadeInUp">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li class="active"><?= htmlspecialchars($service['title']); ?></li>
                    </ul>   
                </div>
            </div>
        </div>

        <div class="gradient-edge-bottom h-50"></div>
        <div class="sw-overlay"></div>
    </section>
     
    <!-- Main Service Details Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                
                <!-- Left Content Column -->
                <div class="col-lg-8">
                    
                    <!-- Main Service Hero Image -->
                    <div class="mb-4 rounded-1 overflow-hidden shadow-sm wow fadeInUp">
                        <img src="<?= htmlspecialchars($hero_img); ?>" 
                             class="w-100" 
                             style="max-height: 460px; object-fit: cover; object-position: center; display: block;" 
                             alt="<?= htmlspecialchars($service['title']); ?>">
                    </div>

                    <!-- Intro Box -->
                    <div class="mb-4 wow fadeInUp" data-wow-delay=".1s">
                        <?php if (!empty($service['tag_label'])): ?>
                            <div class="subtitle id-color mb-2"><?= htmlspecialchars($service['tag_label']); ?></div>
                        <?php endif; ?>
                        
                        <h2 class="text-dark mb-3"><?= !empty($service['heading']) ? htmlspecialchars($service['heading']) : htmlspecialchars($service['title']); ?></h2>
                        
                        <?php if (!empty($service['short_description'])): ?>
                            <div class="fs-18 lh-1-7 text-dark fw-500 mb-4 p-3 bg-light rounded-1 border-start border-4 border-primary">
                                <?= $service['short_description']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Detail Images Strip if available -->
                    <?php if ($detail_img1 || $detail_img2): ?>
                        <div class="row g-3 mb-4 wow fadeInUp">
                            <?php if ($detail_img1): ?>
                                <div class="<?= $detail_img2 ? 'col-md-6' : 'col-12' ?>">
                                    <img src="<?= htmlspecialchars($detail_img1) ?>" class="w-100 rounded-1 shadow-sm" style="height: 240px; object-fit: cover;" alt="Service visual 1">
                                </div>
                            <?php endif; ?>
                            <?php if ($detail_img2): ?>
                                <div class="<?= $detail_img1 ? 'col-md-6' : 'col-12' ?>">
                                    <img src="<?= htmlspecialchars($detail_img2) ?>" class="w-100 rounded-1 shadow-sm" style="height: 240px; object-fit: cover;" alt="Service visual 2">
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Long Description (Rich HTML Content) -->
                    <?php if (!empty($service['long_description'])): ?>
                        <div class="mb-5 wow fadeInUp service-long-description" data-wow-delay=".2s" style="line-height: 1.8; font-size: 16px; color: #334155;">
                            <?= $service['long_description']; ?>
                        </div>
                    <?php endif; ?>

                    <!-- What We Provide Section -->
                    <div class="mb-5 wow fadeInUp" data-wow-delay=".2s">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fs-28 text-blue icon_box-checked me-2"></i>
                            <h3 class="mb-0 text-dark">What We Provide</h3>
                        </div>
                        <p class="text-muted mb-4">Our specialized end-to-end scope of services for <?= htmlspecialchars($service['title']); ?> includes:</p>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-1 border-gray h-100 d-flex align-items-center">
                                    <div class="circle bg-color text-dark me-3 flex-shrink-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                        <i class="fa fa-check fs-13"></i>
                                    </div>
                                    <span class="fw-600 text-dark fs-15">Customized Engineering & Planning</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-1 border-gray h-100 d-flex align-items-center">
                                    <div class="circle bg-color text-dark me-3 flex-shrink-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                        <i class="fa fa-check fs-13"></i>
                                    </div>
                                    <span class="fw-600 text-dark fs-15">Tier-1 Components & Modules</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-1 border-gray h-100 d-flex align-items-center">
                                    <div class="circle bg-color text-dark me-3 flex-shrink-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                        <i class="fa fa-check fs-13"></i>
                                    </div>
                                    <span class="fw-600 text-dark fs-15">Grid Integration & Approvals</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-1 border-gray h-100 d-flex align-items-center">
                                    <div class="circle bg-color text-dark me-3 flex-shrink-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                        <i class="fa fa-check fs-13"></i>
                                    </div>
                                    <span class="fw-600 text-dark fs-15">Complete Testing & Commissioning</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Work Process Steps -->
                    <div class="wow fadeInUp" data-wow-delay=".4s">
                        <div class="subtitle mb-2">OUR METHODOLOGY</div>
                        <h3 class="text-dark mb-4">How We Deliver Results</h3>
                        
                        <div class="row g-3">
                            <div class="col-sm-6 col-md-3">
                                <div class="p-3 bg-light rounded-1 text-center h-100 border-gray">
                                    <span class="fs-24 fw-800 text-blue d-block mb-1">01</span>
                                    <h6 class="fw-bold text-dark mb-1">Consultation</h6>
                                    <p class="fs-12 text-muted mb-0">Initial site & energy load assessment</p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="p-3 bg-light rounded-1 text-center h-100 border-gray">
                                    <span class="fs-24 fw-800 text-blue d-block mb-1">02</span>
                                    <h6 class="fw-bold text-dark mb-1">Engineering</h6>
                                    <p class="fs-12 text-muted mb-0">Customized layout, capacity & CAD design</p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="p-3 bg-light rounded-1 text-center h-100 border-gray">
                                    <span class="fs-24 fw-800 text-blue d-block mb-1">03</span>
                                    <h6 class="fw-bold text-dark mb-1">Installation</h6>
                                    <p class="fs-12 text-muted mb-0">High-grade execution with certified experts</p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="p-3 bg-light rounded-1 text-center h-100 border-gray">
                                    <span class="fs-24 fw-800 text-blue d-block mb-1">04</span>
                                    <h6 class="fw-bold text-dark mb-1">Commissioning</h6>
                                    <p class="fs-12 text-muted mb-0">Grid sync, safety testing & ongoing support</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Sidebar Column -->
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px; z-index: 10;">
                        
                        <!-- All Services Menu Widget -->
                        <div class="p-4 bg-light rounded-1 border-gray mb-4 shadow-sm wow fadeInUp">
                            <h4 class="text-dark mb-3 pb-2 border-bottom">All Services</h4>
                            <ul class="list-unstyled mb-0">
                                <?php if (!empty($all_services)): 
                                    $cnt = 1;
                                    foreach ($all_services as $s_item): 
                                        $is_active = ($s_item['slug'] === $service['slug'] || $s_item['id'] == $service['id']);
                                ?>
                                    <li class="mb-2">
                                        <a href="service-single.php?id=<?= urlencode($s_item['slug']); ?>" 
                                           class="d-flex align-items-center justify-content-between p-3 rounded-1 text-decoration-none transition-all <?= $is_active ? 'bg-color text-dark fw-bold shadow-sm' : 'bg-white text-dark hover-bg-light border-gray'; ?>">
                                            <span class="fs-14">
                                                <span class="op-6 me-2"><?= sprintf("%02d", $cnt++); ?>.</span>
                                                <?= htmlspecialchars($s_item['title']); ?>
                                            </span>
                                            <i class="fa fa-angle-right <?= $is_active ? 'text-dark' : 'text-blue'; ?>"></i>
                                        </a>
                                    </li>
                                <?php endforeach; endif; ?>
                            </ul>
                        </div>

                        <!-- Quick Contact Widget -->
                        <div class="p-4 bg-dark text-white rounded-1 shadow-sm mb-4 wow fadeInUp" data-wow-delay=".1s">
                            <div class="subtitle id-color mb-2">NEED ASSISTANCE?</div>
                            <h4 class="text-white mb-3">Speak to Our Solar Engineer</h4>
                            <p class="fs-14 text-white-50 mb-3">Get tailored technical advice and estimated project quotations from AK ENERGIES specialists.</p>
                            
                            <div class="d-flex align-items-center mb-3">
                                <i class="fs-24 text-blue icon_phone me-3"></i>
                                <div>
                                    <div class="fs-12 text-white-50">Call Us Anytime</div>
                                    <a href="tel:+1800987654" class="text-white fw-bold fs-16 text-decoration-none">+1 800 987 654</a>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-4">
                                <i class="fs-24 text-blue icon_mail me-3"></i>
                                <div>
                                    <div class="fs-12 text-white-50">Email Us</div>
                                    <a href="mailto:support@akenergies.com" class="text-white fw-bold fs-15 text-decoration-none">support@akenergies.com</a>
                                </div>
                            </div>

                            <a href="contact.php?service=<?= urlencode($service['slug']); ?>" class="btn-main w-100 text-center fx-slide">
                                <span>REQUEST QUOTE FOR THIS SERVICE</span>
                            </a>
                            <a href="https://wa.me/1800987654?text=Hi%20AK%20Energies%2C%20I%20am%20interested%20in%20<?= urlencode($service['title']); ?>" target="_blank" rel="noopener noreferrer" class="btn-main btn-line fx-slide w-100 text-center mt-2 hover-white" style="border-color: rgba(255,255,255,0.2);">
                                <span><i class="fa-brands fa-whatsapp me-1 text-success"></i> WhatsApp Inquiry</span>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Common CTA for All Service Pages -->
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
                            <span>GET A QUOTE</span>
                        </a>
                        <a href="contact.php" class="btn-main btn-line fx-slide">
                            <span>CONTACT US</span>
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
