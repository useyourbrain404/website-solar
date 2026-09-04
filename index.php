<?php
$page_title = "AK Energies - Solar & Renewable Energy";
$page_description = "AK Energies - Power Your Future with Clean Energy";
$current_page = "home";
$extra_scripts = [
    'js/custom-swiper-3.js',
    'js/custom-marquee.js'
];
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/header.php';
?>

<!-- content begin -->
<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <?php require_once __DIR__ . '/includes/slider.php'; ?>

    <section>
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="relative">
                        <div class="abs bottom-0 end-0">
                            <div class="p-4 mb-4 bg-color text-white rounded-1 text-center wow fadeInUp"
                                data-wow-delay=".0s">
                                <h1 class="fs-48 fw-bold mb-1 text-white">5+</h1>
                                <div class="fs-15 fw-600 lh-1-5 text-white">Years of Experience</div>
                            </div>
                        </div>
                        <div class="abs w-80">
                            <img src="images/misc/main-1.jpg" class="w-70 rounded-1 overflow-hidden"
                                alt="AK ENERGIES Solar Installation">
                        </div>
                        <div class="mb-4 d-inline-block p-30 mb-4 mt-4 text-end">
                            <img src="images/misc/L-pro-4.jpg" class="w-80 rounded-1 overflow-hidden"
                                alt="AK ENERGIES Solar Panels">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="subtitle id-color wow fadeInUp" data-wow-delay=".0s">SOLAR POWER FOR A SMARTER FUTURE
                    </div>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">Powering a Smarter, <span class="op-3">Sustainable
                            Future</span></h2>
                    <p class="wow fadeInUp" data-wow-delay=".3s">AK ENERGIES is committed to delivering reliable,
                        efficient, and sustainable solar energy solutions for homes, businesses, industries, and
                        institutions. From initial consultation and system design to installation and commissioning, we
                        provide complete solar solutions tailored to every customer's energy requirements.</p>
                    <p class="wow fadeInUp" data-wow-delay=".4s">Our focus is on quality, innovation, performance, and
                        long-term value, helping customers reduce electricity costs, improve energy efficiency, and move
                        towards a cleaner and more sustainable future.</p>

                    <div class="border-bottom mb-4"></div>

                    <ul class="ul-check mb-4 wow fadeInUp" data-wow-delay=".5s">
                        <li class="mb-3">
                            <h5 class="fs-16 mb-1">Reduce Electricity Costs</h5>
                            <p class="mb-0">Generate your own clean power and reduce your dependence on conventional
                                electricity.</p>
                        </li>
                        <li class="mb-3">
                            <h5 class="fs-16 mb-1">Clean &amp; Renewable Energy</h5>
                            <p class="mb-0">Harness the power of the sun and contribute to a greener environment.</p>
                        </li>
                        <li class="mb-3">
                            <h5 class="fs-16 mb-1">Energy Independence</h5>
                            <p class="mb-0">Reduce reliance on the traditional power grid with reliable solar energy.
                            </p>
                        </li>
                        <li class="mb-3">
                            <h5 class="fs-16 mb-1">Long-Term Savings</h5>
                            <p class="mb-0">Invest in a sustainable energy solution designed to deliver value for years
                                to come.</p>
                        </li>
                    </ul>

                    <div class="mt-4 wow fadeInUp" data-wow-delay=".6s">
                        <a class="btn-main fx-slide" href="about.php"><span>LEARN MORE ABOUT US</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="subtitle wow fadeInUp mb-3">SOLAR ENERGY SERVICES</div>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">Reliable, Renewable, and <span
                            class="op-3">Cost-Effective Energy</span></h2>
                    <p class="lead mb-0 wow fadeInUp">AK ENERGIES delivers complete solar energy solutions designed to
                        reduce electricity costs, improve energy efficiency, and provide reliable clean power for homes,
                        businesses, industries, and large-scale projects.</p>
                    <div class="spacer-single"></div>
                    <div class="spacer-half"></div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-sm-6">
                    <div class="hover">
                        <div class="relative overflow-hidden">
                            <a href="service-single.php" class="d-block hover">
                                <div class="relative overflow-hidden rounded-1">
                                    <img src="images/services/ro-1.jpg" class="w-100 hover-scale-1-2"
                                        style="height: 300px; object-fit: cover;" alt="SOLAR ROOFTOP SYSTEMS">
                                </div>
                            </a>
                            <div class="p-30 relative bg-white rounded-1 mx-4 mt-min-100">
                                <div class="abs top-0 end-0 mt-min-30 me-4 circle bg-color w-60px h-60px">
                                    <a href="service-single.php">
                                        <img src="images/misc/up-right-arrow-white.webp" class="w-60px p-20" alt="">
                                    </a>
                                </div>
                                <h4>SOLAR ROOFTOP SYSTEMS</h4>
                                <p class="mb-0">Turn your rooftop into a reliable source of clean energy with customized
                                    solar systems designed to reduce electricity costs and deliver long-term savings.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="hover">
                        <div class="relative overflow-hidden">
                            <a href="service-single.php" class="d-block hover">
                                <div class="relative overflow-hidden rounded-1">
                                    <img src="images/services/reo1.jpg" class="w-100 hover-scale-1-2"
                                        style="height: 300px; object-fit: cover;" alt="SOLAR EPC UTILITY GRID PROJECTS">
                                </div>
                            </a>
                            <div class="p-30 relative bg-white rounded-1 mx-4 mt-min-100">
                                <div class="abs top-0 end-0 mt-min-30 me-4 circle bg-color w-60px h-60px">
                                    <a href="service-single.php">
                                        <img src="images/misc/up-right-arrow-white.webp" class="w-60px p-20" alt="">
                                    </a>
                                </div>
                                <h4>SOLAR EPC UTILITY GRID PROJECTS</h4>
                                <p class="mb-0">Complete EPC solutions covering engineering, procurement, installation,
                                    testing, and commissioning for efficient and reliable grid-connected solar power
                                    projects.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-6">
                    <div class="hover">
                        <div class="relative overflow-hidden">
                            <a href="service-single.php" class="d-block hover">
                                <div class="relative overflow-hidden rounded-1">
                                    <img src="images/services/sero.jpg" class="w-100 hover-scale-1-2"
                                        style="height: 300px; object-fit: cover;" alt="SOLAR FARMS SOLUTIONS">
                                </div>
                            </a>
                            <div class="p-30 relative bg-white rounded-1 mx-4 mt-min-100">
                                <div class="abs top-0 end-0 mt-min-30 me-4 circle bg-color w-60px h-60px">
                                    <a href="service-single.php">
                                        <img src="images/misc/up-right-arrow-white.webp" class="w-60px p-20" alt="">
                                    </a>
                                </div>
                                <h4>SOLAR FARMS SOLUTIONS</h4>
                                <p class="mb-0">End-to-end solar farm solutions for large-scale renewable energy
                                    generation, from project planning and system design to installation and
                                    commissioning.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <a class="btn-main fx-slide" href="services.php"><span>VIEW ALL SERVICES</span></a>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-dark text-light">
        <div class="container relative z-1">
            <div class="row g-4 gx-5 align-items-center">

                <div class="col-lg-6">
                    <div class="relative">
                        <div
                            class="bg-blur text-light text-center rounded-1 abs w-200px p-4 m-4 bottom-0 z-3 overflow-hidden wow zoomIn">
                            <h2 class="mb-0">100%</h2>
                            <p class="lh-1-5">Committed to Clean Energy</p>
                        </div>
                        <div class="rounded-1 w-90 overflow-hidden wow zoomIn">
                            <img src="images/services/reo1.jpg" class="w-100 wow scaleIn"
                                alt="AK ENERGIES Solar Projects">
                        </div>
                        <div class="rounded-1 w-50 abs mb-min-50 end-0 bottom-0 z-2 overflow-hidden shadow-soft wow zoomIn"
                            data-wow-delay=".2s">
                            <img src="images/services/sero.jpg" class="w-100 wow scaleIn" data-wow-delay=".2s"
                                alt="AK ENERGIES Solar Performance">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="subtitle id-color wow fadeInUp">WHY CHOOSE AK ENERGIES?</div>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">Powering Your Future with <span class="op-3">Solar
                            Expertise</span></h2>
                    <p class="wow fadeInUp" data-wow-delay=".3s">At AK ENERGIES, we combine technical expertise, quality
                        technology, and professional project execution to deliver reliable solar energy solutions built
                        for long-term performance and value.</p>
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="h-100 rounded-1">
                                <div class="relative wow fadeInUp" data-wow-delay=".0s">
                                    <h4 class="d-flex align-items-center mb-2 fs-18">
                                        <span class="fs-14 fw-600 op-5 me-2">01 ·</span>

                                        <span>Expert Team</span>
                                    </h4>
                                    <p class="mb-0 op-8 fs-14">Our experienced professionals bring technical knowledge
                                        and practical expertise to every solar project, from planning to commissioning.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="h-100 rounded-1">
                                <div class="relative wow fadeInUp" data-wow-delay=".2s">
                                    <h4 class="d-flex align-items-center mb-2 fs-18">
                                        <span class="fs-14 fw-600 op-5 me-2">02 ·</span>

                                        <span>Customized Solutions</span>
                                    </h4>
                                    <p class="mb-0 op-8 fs-14">We design every solar system according to your energy
                                        needs, site conditions, available space, and future requirements.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="h-100 rounded-1">
                                <div class="relative wow fadeInUp" data-wow-delay=".4s">
                                    <h4 class="d-flex align-items-center mb-2 fs-18">
                                        <span class="fs-14 fw-600 op-5 me-2">03 ·</span>

                                        <span>Quality That Performs</span>
                                    </h4>
                                    <p class="mb-0 op-8 fs-14">We use reliable components and proven solar technology to
                                        deliver safe, efficient, and long-lasting system performance.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="h-100 rounded-1">
                                <div class="relative wow fadeInUp" data-wow-delay=".6s">
                                    <h4 class="d-flex align-items-center mb-2 fs-18">
                                        <span class="fs-14 fw-600 op-5 me-2">04 ·</span>

                                        <span>Complete Solar Solutions</span>
                                    </h4>
                                    <p class="mb-0 op-8 fs-14">From consultation and engineering to installation,
                                        commissioning, and maintenance, we provide complete solutions under one roof.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="h-100 rounded-1">
                                <div class="relative wow fadeInUp" data-wow-delay=".8s">
                                    <h4 class="d-flex align-items-center mb-2 fs-18">
                                        <span class="fs-14 fw-600 op-5 me-2">05 ·</span>

                                        <span>Long-Term Savings</span>
                                    </h4>
                                    <p class="mb-0 op-8 fs-14">Our solar solutions help reduce electricity costs,
                                        improve energy efficiency, and deliver greater value from your solar investment.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="h-100 rounded-1">
                                <div class="relative wow fadeInUp" data-wow-delay="1.0s">
                                    <h4 class="d-flex align-items-center mb-2 fs-18">
                                        <span class="fs-14 fw-600 op-5 me-2">06 ·</span>

                                        <span>Dedicated Support</span>
                                    </h4>
                                    <p class="mb-0 op-8 fs-14">We provide responsive support throughout the project
                                        lifecycle to ensure smooth installation and reliable system performance.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="spacer-double"></div>

    </section>

    <section>
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="subtitle wow fadeInUp mb-3">OUR SOLAR PROJECTS</div>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">Powering a Brighter Future <span class="op-3">with
                            Clean Energy</span></h2>
                    <p class="lead mb-0 wow fadeInUp">Explore our solar installations across residential, commercial,
                        and large-scale applications. Each project reflects our commitment to quality engineering,
                        reliable technology, and efficient clean-energy solutions.</p>
                    <div class="spacer-single"></div>
                    <div class="spacer-half"></div>
                </div>
            </div>


            <div class="row g-4">
                <div class="col-lg-12 wow fadeInUp">
                    <div class="overflow-hidden rounded-1">
                        <div class="relative wow fadeIn">
                            <div class="owl-custom-nav menu-float" data-target="#projects-carousel">
                                <a class="btn-next"></a>
                                <a class="btn-prev"></a>

                                <div id="projects-carousel" class="owl-3-cols owl-carousel owl-theme">
                                    <!-- Card 1 -->
                                    <div class="item">
                                        <a href="projects.php">
                                            <div class="hover rounded-1 relative overflow-hidden text-light">
                                                <div class="abs p-40 top-0 z-3">
                                                    <img src="images/misc/up-right-arrow-white.webp"
                                                        class="w-10 mb-3 wow scaleIn" alt="">
                                                </div>
                                                <div class="abs p-40 bottom-0 z-3">
                                                    <h3>Residential Rooftop Solar</h3>
                                                    <p class="mb-0 hover-mh-60">Efficient rooftop solar systems designed
                                                        to help homes generate clean electricity and reduce dependence
                                                        on grid power.</p>
                                                </div>
                                                <div class="hover-op-05 bg-dark abs w-100 h-100 top-0 start-0 z-2">
                                                </div>
                                                <img src="images/projects/pro-2.jpg" class="w-100 hover-scale-1-2"
                                                    style="height: 480px; object-fit: cover;"
                                                    alt="Residential Rooftop Solar">
                                                <div class="gradient-edge-bottom h-50"></div>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- Card 2 -->
                                    <div class="item">
                                        <a href="projects.php">
                                            <div class="hover rounded-1 relative overflow-hidden text-light">
                                                <div class="abs p-40 top-0 z-3">
                                                    <img src="images/misc/up-right-arrow-white.webp"
                                                        class="w-10 mb-3 wow scaleIn" alt="">
                                                </div>
                                                <div class="abs p-40 bottom-0 z-3">
                                                    <h3>Large-Scale Solar Projects</h3>
                                                    <p class="mb-0 hover-mh-60">Professionally planned solar
                                                        installations for large-scale renewable energy generation with a
                                                        focus on reliable performance and long-term value.</p>
                                                </div>
                                                <div class="hover-op-05 bg-dark abs w-100 h-100 top-0 start-0 z-2">
                                                </div>
                                                <img src="images/projects/L-pro-4.jpg" class="w-100 hover-scale-1-2"
                                                    style="height: 480px; object-fit: cover;"
                                                    alt="Large-Scale Solar Projects">
                                                <div class="gradient-edge-bottom h-50"></div>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- Card 3 -->
                                    <div class="item">
                                        <a href="projects.php">
                                            <div class="hover rounded-1 relative overflow-hidden text-light">
                                                <div class="abs p-40 top-0 z-3">
                                                    <img src="images/misc/up-right-arrow-white.webp"
                                                        class="w-10 mb-3 wow scaleIn" alt="">
                                                </div>
                                                <div class="abs p-40 bottom-0 z-3">
                                                    <h3>Commercial &amp; Industrial Solar</h3>
                                                    <p class="mb-0 hover-mh-60">Customized solar solutions for
                                                        businesses and industries, designed to improve energy efficiency
                                                        and deliver long-term savings.</p>
                                                </div>
                                                <div class="hover-op-05 bg-dark abs w-100 h-100 top-0 start-0 z-2">
                                                </div>
                                                <img src="images/projects/2-pro.jpg" class="w-100 hover-scale-1-2"
                                                    style="height: 480px; object-fit: cover;"
                                                    alt="Commercial & Industrial Solar">
                                                <div class="gradient-edge-bottom h-50"></div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a class="btn-main fx-slide" href="projects.php"><span>VIEW ALL PROJECTS</span></a>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-color text-light no-top no-bottom overflow-hidden">
        <div class="container-fluid relative half-fluid">
            <div class="container">
                <div class="row">
                    <!-- Image -->
                    <div class="col-lg-6 position-lg-absolute left-half h-100">
                        <div class="image wow fadeInLeft" data-bgimage="url(images/misc/s2.webp)"></div>
                    </div>
                    <!-- Text -->
                    <div class="col-lg-5 offset-lg-7">
                        <div class="me-lg-3">
                            <div class="py-5 my-5">
                                <div class="owl-single-dots owl-carousel owl-theme">
                                    <div class="item">
                                        <i class="icofont-quote-left text-white fs-32 d-block mb-3 wow fadeInUp"></i>
                                        <p class="fs-18 fw-500 text-white mb-4 wow fadeInUp lh-1-7">
                                            "Switching to solar with AK ENERGIES was the best decision we made.
                                            Lower bills, clean energy, and outstanding support every step of the way."
                                        </p>
                                        <span class="wow fadeInUp fw-bold text-white fs-15">Alex Morgan</span>
                                    </div>

                                    <div class="item">
                                        <i class="icofont-quote-left text-white fs-32 d-block mb-3 wow fadeInUp"></i>
                                        <p class="fs-18 fw-500 text-white mb-4 wow fadeInUp lh-1-7">
                                            "Thanks to their expert team, our business now runs on 100% solar power.
                                            Reliable, affordable, and eco-friendly—highly recommended!"
                                        </p>
                                        <span class="wow fadeInUp fw-bold text-white fs-15">Jamie Chen</span>
                                    </div>

                                    <div class="item">
                                        <i class="icofont-quote-left text-white fs-32 d-block mb-3 wow fadeInUp"></i>
                                        <p class="fs-18 fw-500 text-white mb-4 wow fadeInUp lh-1-7">
                                            "The installation was smooth and the results were instant. We've seen a huge
                                            reduction in our energy costs. Go solar—it’s worth it!"
                                        </p>
                                        <span class="wow fadeInUp fw-bold text-white fs-15">Priya Kumar</span>
                                    </div>

                                    <div class="item">
                                        <i class="icofont-quote-left text-white fs-32 d-block mb-3 wow fadeInUp"></i>
                                        <p class="fs-18 fw-500 text-white mb-4 wow fadeInUp lh-1-7">
                                            "I never imagined powering my home with sunlight could be this easy. The
                                            team made everything clear and seamless."
                                        </p>
                                        <span class="wow fadeInUp fw-bold text-white fs-15">Liam Stewart</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="p-0" aria-label="section">
        <div class="bg-dark d-flex py-3 lh-1 align-items-center">
            <div class="de-marquee-list-2 wow fadeIn d-flex align-items-center">
                <span class="fs-18 fw-600 mx-3 text-white">Solar Panel Installation</span>
                <img src="images/logo-icon-badge.webp" class="mx-3"
                    style="width: 32px; height: 32px; object-fit: contain; vertical-align: middle; display: inline-block;"
                    alt="AK Energies">
                <span class="fs-18 fw-600 mx-3 text-white">Energy Storage Systems</span>
                <img src="images/logo-icon-badge.webp" class="mx-3"
                    style="width: 32px; height: 32px; object-fit: contain; vertical-align: middle; display: inline-block;"
                    alt="AK Energies">
                <span class="fs-18 fw-600 mx-3 text-white">Off-Grid Solutions</span>
                <img src="images/logo-icon-badge.webp" class="mx-3"
                    style="width: 32px; height: 32px; object-fit: contain; vertical-align: middle; display: inline-block;"
                    alt="AK Energies">
                <span class="fs-18 fw-600 mx-3 text-white">System Maintenance</span>
                <img src="images/logo-icon-badge.webp" class="mx-3"
                    style="width: 32px; height: 32px; object-fit: contain; vertical-align: middle; display: inline-block;"
                    alt="AK Energies">
                <span class="fs-18 fw-600 mx-3 text-white">Solar Financing</span>
                <img src="images/logo-icon-badge.webp" class="mx-3"
                    style="width: 32px; height: 32px; object-fit: contain; vertical-align: middle; display: inline-block;"
                    alt="AK Energies">
                <span class="fs-18 fw-600 mx-3 text-white">Energy Efficiency Audit</span>
                <img src="images/logo-icon-badge.webp" class="mx-3"
                    style="width: 32px; height: 32px; object-fit: contain; vertical-align: middle; display: inline-block;"
                    alt="AK Energies">
                <span class="fs-18 fw-600 mx-3 text-white">EV Charger Installation</span>
                <img src="images/logo-icon-badge.webp" class="mx-3"
                    style="width: 32px; height: 32px; object-fit: contain; vertical-align: middle; display: inline-block;"
                    alt="AK Energies">
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="subtitle id-color wow fadeInUp" data-wow-delay=".0s">EVERYTHING YOU NEED TO KNOW</div>
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">Frequently Asked Questions</h2>
                </div>

                <div class="col-lg-7">
                    <div class="accordion s2 wow fadeInUp">
                        <div class="accordion-section">
                            <div class="accordion-section-title" data-tab="#accordion-a1">
                                How does solar energy work?
                            </div>
                            <div class="accordion-section-content" id="accordion-a1">
                                Solar panels capture sunlight and convert it into electricity using photovoltaic
                                technology. The generated power can be used to meet your energy requirements and reduce
                                dependence on grid electricity.
                            </div>
                            <div class="accordion-section-title" data-tab="#accordion-a2">
                                Can solar energy reduce my electricity bills?
                            </div>
                            <div class="accordion-section-content" id="accordion-a2">
                                Yes. A properly designed solar system can reduce your dependence on grid power and help
                                lower electricity costs while providing clean, renewable energy.
                            </div>
                            <div class="accordion-section-title" data-tab="#accordion-a3">
                                Is my property suitable for solar installation?
                            </div>
                            <div class="accordion-section-content" id="accordion-a3">
                                Most homes, businesses, industries, and institutions can benefit from solar if suitable
                                rooftop or ground space is available. Our team can assess your site and energy
                                requirements to recommend the right solution.
                            </div>
                            <div class="accordion-section-title" data-tab="#accordion-a4">
                                How long does a solar system last?
                            </div>
                            <div class="accordion-section-content" id="accordion-a4">
                                A quality solar system is designed for long-term performance. With proper installation,
                                regular maintenance, and performance monitoring, it can provide reliable clean energy
                                for many years.
                            </div>
                            <div class="accordion-section-title" data-tab="#accordion-a5">
                                Do solar panels work on cloudy days?
                            </div>
                            <div class="accordion-section-content" id="accordion-a5">
                                Yes. Solar panels can still generate electricity from available daylight on cloudy days,
                                although energy generation may be lower compared with bright, sunny conditions.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- As Seen On / Client & Media Logo Scroll Section -->
    <section class="as-seen-on-section">
        <div class="container-fluid p-0">
            <h3 class="as-seen-on-title wow fadeInUp" data-wow-delay=".1s">As Seen On</h3>

            <div class="as-seen-on-container">
                <!-- Row 1: Scrolling Left -->
                <div class="as-seen-on-row">
                    <div class="as-seen-on-track">
                        <!-- Item 1: Good Returns -->
                        <div class="client-logo-card" title="Good Returns">
                            <img src="images/clients/good-returns.svg" alt="Good Returns">
                        </div>
                        <!-- Item 2: Live Hindustan -->
                        <div class="client-logo-card" title="Live Hindustan">
                            <img src="images/clients/hindustan.svg" alt="Live Hindustan">
                        </div>
                        <!-- Item 3: Hindustan Times -->
                        <div class="client-logo-card" title="Hindustan Times">
                            <img src="images/clients/hindustan-times.svg" alt="Hindustan Times">
                        </div>
                        <!-- Item 4: HRKatha -->
                        <div class="client-logo-card" title="HRKatha">
                            <img src="images/clients/hr-katha.svg" alt="HR Katha">
                        </div>
                        <!-- Item 5: Aaj Tak -->
                        <div class="client-logo-card" title="Aaj Tak">
                            <img src="images/clients/aaj-tak.svg" alt="Aaj Tak">
                        </div>
                        <!-- Item 6: BusinessLine -->
                        <div class="client-logo-card" title="The Hindu BusinessLine">
                            <img src="images/clients/business-line.svg" alt="The Hindu BusinessLine">
                        </div>
                        <!-- Item 7: Business Standard -->
                        <div class="client-logo-card" title="Business Standard">
                            <img src="images/clients/business-standard.svg" alt="Business Standard">
                        </div>
                        <!-- Item 8: Economic Times -->
                        <div class="client-logo-card" title="The Economic Times">
                            <img src="images/clients/economic-times.svg" alt="The Economic Times">
                        </div>
                        <!-- Item 9: Moneycontrol -->
                        <div class="client-logo-card" title="Moneycontrol">
                            <img src="images/clients/moneycontrol.svg" alt="Moneycontrol">
                        </div>
                        <!-- Item 10: Fortune -->
                        <div class="client-logo-card" title="Fortune India">
                            <img src="images/clients/fortune.svg" alt="Fortune India">
                        </div>

                        <!-- Duplicate Set for Seamless Continuous Scroll -->
                        <div class="client-logo-card" title="Good Returns">
                            <img src="images/clients/good-returns.svg" alt="Good Returns">
                        </div>
                        <div class="client-logo-card" title="Live Hindustan">
                            <img src="images/clients/hindustan.svg" alt="Live Hindustan">
                        </div>
                        <div class="client-logo-card" title="Hindustan Times">
                            <img src="images/clients/hindustan-times.svg" alt="Hindustan Times">
                        </div>
                        <div class="client-logo-card" title="HRKatha">
                            <img src="images/clients/hr-katha.svg" alt="HR Katha">
                        </div>
                        <div class="client-logo-card" title="Aaj Tak">
                            <img src="images/clients/aaj-tak.svg" alt="Aaj Tak">
                        </div>
                        <div class="client-logo-card" title="The Hindu BusinessLine">
                            <img src="images/clients/business-line.svg" alt="The Hindu BusinessLine">
                        </div>
                        <div class="client-logo-card" title="Business Standard">
                            <img src="images/clients/business-standard.svg" alt="Business Standard">
                        </div>
                        <div class="client-logo-card" title="The Economic Times">
                            <img src="images/clients/economic-times.svg" alt="The Economic Times">
                        </div>
                        <div class="client-logo-card" title="Moneycontrol">
                            <img src="images/clients/moneycontrol.svg" alt="Moneycontrol">
                        </div>
                        <div class="client-logo-card" title="Fortune India">
                            <img src="images/clients/fortune.svg" alt="Fortune India">
                        </div>
                    </div>
                </div>

                <!-- Row 2: Scrolling Right -->
                <div class="as-seen-on-row">
                    <div class="as-seen-on-track scroll-right">
                        <!-- Item 1: The Week -->
                        <div class="client-logo-card" title="The Week">
                            <img src="images/clients/the-week.svg" alt="The Week">
                        </div>
                        <!-- Item 2: Times Now -->
                        <div class="client-logo-card" title="Times Now">
                            <img src="images/clients/times-now.svg" alt="Times Now">
                        </div>
                        <!-- Item 3: YourStory -->
                        <div class="client-logo-card" title="YourStory">
                            <img src="images/clients/yourstory.svg" alt="YourStory">
                        </div>
                        <!-- Item 4: Zee Business -->
                        <div class="client-logo-card" title="Zee Business">
                            <img src="images/clients/zee-business.svg" alt="Zee Business">
                        </div>
                        <!-- Item 5: India.com -->
                        <div class="client-logo-card" title="India.com">
                            <img src="images/clients/india-com.svg" alt="India.com">
                        </div>
                        <!-- Item 6: IIFL -->
                        <div class="client-logo-card" title="IIFL">
                            <img src="images/clients/iifl.svg" alt="IIFL">
                        </div>
                        <!-- Item 7: India Today -->
                        <div class="client-logo-card" title="India Today">
                            <img src="images/clients/india-today.svg" alt="India Today">
                        </div>
                        <!-- Item 8: CNBC TV18 -->
                        <div class="client-logo-card" title="CNBC TV18">
                            <img src="images/clients/cnbc-tv18.svg" alt="CNBC TV18">
                        </div>
                        <!-- Item 9: LiveMint -->
                        <div class="client-logo-card" title="LiveMint">
                            <img src="images/clients/livemint.svg" alt="LiveMint">
                        </div>
                        <!-- Item 10: NDTV Profit -->
                        <div class="client-logo-card" title="NDTV Profit">
                            <img src="images/clients/ndtv-profit.svg" alt="NDTV Profit">
                        </div>

                        <!-- Duplicate Set for Seamless Continuous Scroll -->
                        <div class="client-logo-card" title="The Week">
                            <img src="images/clients/the-week.svg" alt="The Week">
                        </div>
                        <div class="client-logo-card" title="Times Now">
                            <img src="images/clients/times-now.svg" alt="Times Now">
                        </div>
                        <div class="client-logo-card" title="YourStory">
                            <img src="images/clients/yourstory.svg" alt="YourStory">
                        </div>
                        <div class="client-logo-card" title="Zee Business">
                            <img src="images/clients/zee-business.svg" alt="Zee Business">
                        </div>
                        <div class="client-logo-card" title="India.com">
                            <img src="images/clients/india-com.svg" alt="India.com">
                        </div>
                        <div class="client-logo-card" title="IIFL">
                            <img src="images/clients/iifl.svg" alt="IIFL">
                        </div>
                        <div class="client-logo-card" title="India Today">
                            <img src="images/clients/india-today.svg" alt="India Today">
                        </div>
                        <div class="client-logo-card" title="CNBC TV18">
                            <img src="images/clients/cnbc-tv18.svg" alt="CNBC TV18">
                        </div>
                        <div class="client-logo-card" title="LiveMint">
                            <img src="images/clients/livemint.svg" alt="LiveMint">
                        </div>
                        <div class="client-logo-card" title="NDTV Profit">
                            <img src="images/clients/ndtv-profit.svg" alt="NDTV Profit">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-color text-light py-4">
        <div class="container relative z-1">
            <div class="row g-4 gx-5 align-items-center">

                <div class="col-lg-12">
                    <div class="relative">
                        <div class="row g-4 grid-divider sm-hide">
                            <div class="col-lg-4 col-md-6 mb-sm-30 wow fadeIn fadeInRight" data-wow-delay=".2s">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fs-36 text-blue icon_phone"></i>
                                    <div class="ms-3">
                                        <h5 class="mb-0 fw-bold text-white">Need Our Services?</h5>
                                        <p class="text-white mb-0 fs-14 op-9">Call: +1 800 987 654</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 mb-sm-30 wow fadeIn fadeInRight" data-wow-delay=".4s">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fs-36 text-blue icon_clock"></i>
                                    <div class="ms-3">
                                        <h5 class="mb-0 fw-bold text-white">Work Hours</h5>
                                        <p class="text-white mb-0 fs-14 op-9">Mon to Sat 08:00 - 17:00</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 mb-sm-30 wow fadeIn fadeInRight" data-wow-delay=".6s">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fs-36 text-blue icon_mail"></i>
                                    <div class="ms-3">
                                        <h5 class="mb-0 fw-bold text-white">Email Us</h5>
                                        <p class="text-white mb-0 fs-14 op-9">support@akenergies.com</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
</div>
<!-- content end -->

<?php
require_once __DIR__ . '/includes/footer.php';
require_once __DIR__ . '/includes/scripts.php';
?>