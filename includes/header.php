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
                                    <a href="index.php" title="AK Energies Home">
                                        <img class="logo-main" src="images/logo.png" alt="AK Energies - Solar & Renewable Energy">
                                    </a>
                                </div>
                                <!-- logo end -->
                            </div>
                            <div class="de-flex-col header-col-mid">
                                <!-- mainmenu begin -->
                                <ul id="mainmenu">
                                    <li><a class="menu-item <?php echo ($current_page === 'home') ? 'active' : ''; ?>" href="index.php">Home</a></li>
                                    <li><a class="menu-item <?php echo ($current_page === 'about') ? 'active' : ''; ?>" href="about.php">About Us</a></li>
                                    <li><a class="menu-item <?php echo in_array($current_page, ['services', 'service-single']) ? 'active' : ''; ?>" href="services.php">Services</a></li>
                                    <li><a class="menu-item <?php echo in_array($current_page, ['projects', 'project-single']) ? 'active' : ''; ?>" href="projects.php">Projects</a></li>
                                    <li><a class="menu-item <?php echo ($current_page === 'contact') ? 'active' : ''; ?>" href="contact.php">Contact</a></li>
                                </ul>
                                <!-- mainmenu end -->
                            </div>
                            <div class="de-flex-col">
                                <div class="menu_side_area">
                                    <a href="contact.php" class="btn-main btn-header-quote"><span>Get a Quote</span></a>
                                    <span id="menu-btn" title="Toggle Navigation Menu" role="button" tabindex="0" aria-label="Toggle Navigation Menu" aria-expanded="false"></span>
                                </div>

                                <div id="btn-extra" title="Quick Info Drawer" aria-label="Toggle Quick Info Drawer" role="button" tabindex="0">
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
