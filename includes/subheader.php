<?php
/**
 * Subheader Component for Inner Pages
 */
if (!isset($sub_subtitle)) {
    $sub_subtitle = "Power Your Future with Clean Energy";
}
if (!isset($sub_title)) {
    $sub_title = "Page Title";
}
if (!isset($sub_breadcrumb)) {
    $sub_breadcrumb = $sub_title;
}
if (!isset($sub_bg_image)) {
    $sub_bg_image = "images/background/2.webp";
}
?>
            <section id="subheader" class="bg-dark text-light relative jarallax">
                <img src="<?php echo htmlspecialchars($sub_bg_image); ?>" class="jarallax-img" alt="">
                <div class="container relative z-2">
                    <div class="row gy-4 gx-5 align-items-center">
                        <div class="col-lg-12">
                            <div class="spacer-double sm-hide"></div>
                            <h5 class="wow fadeInUp"><?php echo htmlspecialchars($sub_subtitle); ?></h5>
                            <h1 class="mb-3 wow fadeInUp" data-wow-delay=".2s"><?php echo htmlspecialchars($sub_title); ?></h1>
                            <div class="border-bottom mb-3"></div>
                            <ul class="crumb wow fadeInUp">
                                <li><a href="index.php">Home</a></li>
                                <li class="active"><?php echo htmlspecialchars($sub_breadcrumb); ?></li>
                            </ul>   
                        </div>
                    </div>
                </div>

                <div class="gradient-edge-bottom h-50"></div>
                <div class="sw-overlay"></div>
            </section>
