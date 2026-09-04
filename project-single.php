<?php
$page_title = "Residential Solar Installation - AK Energies";
$page_description = "Detailed case study and impact results of our residential solar project.";
$current_page = "project-single";
$extra_scripts = [
    'js/custom-swiper-1.js',
    'js/custom-marquee.js'
];
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/header.php';
?>

<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <section id="subheader" class="bg-dark text-light relative jarallax">
        <img src="images/background/5.webp" class="jarallax-img" alt="">
        <div class="container relative z-2">
            <div class="row gy-4 gx-5 align-items-center">
                <div class="col-lg-12">
                    <div class="spacer-double sm-hide"></div>
                    <h2 class="mb-3 wow fadeInUp" data-wow-delay=".2s">BrightHome Energy – Residential Solar Panel
                        Installation</h2>
                    <div class="border-bottom mb-3"></div>
                    <ul class="crumb wow fadeInUp">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="projects.php">Projects</a></li>
                        <li class="active">BrightHome Energy – Residential Solar Panel Installation</li>
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
                <div class="col-md-1-5">
                    <div class="border-gray p-30 h-100 rounded-1 wow fadeInRight" data-wow-delay=".0s">
                        <h4 class="mb-0">Category</h4>
                        Home Installation
                    </div>
                </div>

                <div class="col-md-1-5">
                    <div class="border-gray p-30 h-100 rounded-1 wow fadeInRight" data-wow-delay=".2s">
                        <h4 class="mb-0">Location</h4>
                        Residential Property
                    </div>
                </div>

                <div class="col-md-1-5">
                    <div class="border-gray p-30 h-100 rounded-1 wow fadeInRight" data-wow-delay=".4s">
                        <h4 class="mb-0">Status</h4>
                        Completed
                    </div>
                </div>

                <div class="col-md-1-5">
                    <div class="border-gray p-30 h-100 rounded-1 wow fadeInRight" data-wow-delay=".6s">
                        <h4 class="mb-0">Client</h4>
                        Aura Living Corp
                    </div>
                </div>

                <div class="col-md-1-5">
                    <div class="border-gray p-30 h-100 rounded-1 wow fadeInRight" data-wow-delay=".8s">
                        <h4 class="mb-0">Completion Date</h4>
                        30 May 2025
                    </div>
                </div>
            </div>

            <div class="spacer-double"></div>

            <div class="row g-4">
                <div class="col-md-12">
                    <p class="fs-18 fw-500 lh-1-7 wow fadeInUp text-dark">
                        BrightHome Energy successfully completed the installation of a full-scale residential solar
                        panel system on a modern sloped-roof home. This project supports the homeowner’s commitment to
                        sustainability, energy independence, and long-term savings.
                    </p>
                </div>
            </div>

            <div class="spacer-double"></div>

            <div class="row g-4">
                <div class="col-md-6 wow fadeInUp" data-wow-delay=".0s">
                    <h3 class="mb-3">Client Goal</h3>
                    <ul class="ul-check text-dark">
                        <li>Reduce monthly electricity bills</li>
                        <li>Transition to renewable energy</li>
                        <li>Increase property value</li>
                        <li>Gain energy independence with minimal maintenance</li>
                    </ul>
                </div>

                <div class="col-md-6 wow fadeInUp" data-wow-delay=".2s">
                    <h3 class="mb-3">Impact & Results</h3>
                    <ul class="ul-check text-dark">
                        <li>60% electricity cost reduction</li>
                        <li>5.2 tons CO₂ offset annually</li>
                        <li>Energy self-sufficiency</li>
                        <li>Increased home resale value</li>
                    </ul>
                </div>
            </div>

            <div class="spacer-double"></div>

            <div class="row g-4">
                <div class="col-lg-12 wow fadeInUp">
                    <div class="overflow-hidden rounded-1">
                        <div class="relative wow fadeIn">
                            <div class="owl-custom-nav menu-float" data-target="#project-single-carousel">
                                <a class="btn-next"></a>
                                <a class="btn-prev"></a>

                                <div id="project-single-carousel" class="owl-2-cols-center owl-carousel owl-theme">
                                    <!-- project image begin -->
                                    <div class="item">
                                        <div class="hover relative rounded-1 overflow-hidden text-light">
                                            <img src="images/project-single/1.webp" class="w-100" alt="">
                                        </div>
                                    </div>
                                    <!-- project image end -->

                                    <!-- project image begin -->
                                    <div class="item">
                                        <div class="hover relative rounded-1 overflow-hidden text-light">
                                            <img src="images/project-single/2.webp" class="w-100" alt="">
                                        </div>
                                    </div>
                                    <!-- project image end -->

                                    <!-- project image begin -->
                                    <div class="item">
                                        <div class="hover relative rounded-1 overflow-hidden text-light">
                                            <img src="images/project-single/3.webp" class="w-100" alt="">
                                        </div>
                                    </div>
                                    <!-- project image end -->

                                    <!-- project image begin -->
                                    <div class="item">
                                        <div class="hover relative rounded-1 overflow-hidden text-light">
                                            <img src="images/project-single/4.webp" class="w-100" alt="">
                                        </div>
                                    </div>
                                    <!-- project image end -->
                                </div>
                            </div>
                        </div>
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