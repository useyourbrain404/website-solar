<?php
/**
 * Header & Navigation Component
 */
if (!isset($current_page)) {
    $current_page = '';
}
?>
        <!-- header begin -->
        <header class="transparent">
            <div class="container-fluid px-0 pe-lg-4 pe-3">
                <div class="row g-0">
                    <div class="col-12">
                        <div class="de-flex">
                            <div class="de-flex-col">
                                <!-- logo begin -->
                                <div id="logo">
                                    <a href="index.php">
                                        <img class="logo-main" src="images/logo-white.webp" alt="AK Energies">
                                    </a>
                                </div>
                                <!-- logo end -->
                            </div>
                            <div class="de-flex-col header-col-mid">
                                <!-- mainmenu begin -->
                                <ul id="mainmenu">
                                    <li><a class="menu-item <?php echo ($current_page === 'home') ? 'active' : ''; ?>" href="index.php">Home</a></li>
                                    <li><a class="menu-item <?php echo ($current_page === 'about') ? 'active' : ''; ?>" href="about.php">About Us</a></li>
                                    <li><a class="menu-item <?php echo in_array($current_page, ['services', 'service-single', 'services-single']) ? 'active' : ''; ?>" href="services.php">Services</a></li>
                                    <li><a class="menu-item <?php echo in_array($current_page, ['projects', 'project-single']) ? 'active' : ''; ?>" href="projects.php">Projects</a></li>
                                    <li><a class="menu-item <?php echo ($current_page === 'contact') ? 'active' : ''; ?>" href="contact.php">Contact</a></li>
                                </ul>
                                <!-- mainmenu end -->
                            </div>
                            <div class="de-flex-col">
                                <div class="menu_side_area">
                                    <a href="contact.php" class="btn-main btn-line fx-slide hover-white"><span>Get a Quote</span></a>
                                    <span id="menu-btn"></span>
                                </div>

                                <div id="btn-extra">
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header end -->
