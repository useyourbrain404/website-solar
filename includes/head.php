<?php
/**
 * Head Component
 * Provides document head, meta tags, title, favicon, and stylesheet links.
 */
if (!isset($page_title)) {
    $page_title = "AK Energies - Solar & Renewable Energy";
}
if (!isset($page_description)) {
    $page_description = "AK Energies - Solar & Clean Energy Solutions";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <link rel="icon" href="images/icon.webp" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?php echo htmlspecialchars($page_description); ?>" name="description">
    <meta content="solar energy, renewable energy, solar panels, solar installation, clean energy" name="keywords">
    <!-- OpenGraph SEO Meta Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="images/logo-white.webp">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,300..900;1,300..900&family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icofont@1.0.0/dist/icofont.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/elegant-icons@0.0.1/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/et-line@1.0.1/style.css">

    <!-- CSS Files
    ================================================== -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="css/plugins.css" rel="stylesheet" type="text/css">
    <link href="css/swiper.css" rel="stylesheet" type="text/css">
    <link href="css/style.css?v=2.1" rel="stylesheet" type="text/css">
    <!-- color scheme -->
    <link id="colors" href="css/colors/scheme-1.css" rel="stylesheet" type="text/css">
    <link href="css/custom-swiper-1.css" rel="stylesheet" type="text/css">
    <link href="css/usability.css?v=2.1" rel="stylesheet" type="text/css">

</head>

<body>
    <div id="wrapper">
        <a href="#" id="back-to-top" aria-label="Scroll back to top" role="button"></a>

        <!-- preloader begin -->
        <div id="de-loader"></div>
        <!-- preloader end -->
