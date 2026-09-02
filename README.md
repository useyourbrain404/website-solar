# Solaria — Solar & Renewable Energy PHP Website

Solaria is a modern, responsive, high-performance PHP website designed for solar energy contractors, renewable energy providers, green tech companies, and commercial solar installations.

Built with a clean, modular **PHP architecture**, standard **HTML5/PHP**, **Bootstrap 5**, and modern **CSS3 / Vanilla JS**, Solaria offers seamless navigation, dynamic active menus, optimized WebP imagery, interactive carousels, and an integrated contact form.

---

## 🌟 Key Features

- **Pure PHP Architecture**: Common site components (`head`, `header`, `subheader`, `prefooter`, `footer`, `scripts`) are separated into reusable files inside `/includes/` for centralized maintenance.
- **Dynamic Navigation**: Automatic active menu link detection and clean `.php` internal linking across all pages.
- **High-Resolution Optimized Assets**: 100% genuine WebP photographic assets for fast loading and crisp displays across all resolutions (Retina / 4K ready).
- **Interactive UI & Animations**: Smooth sliders with Swiper, parallax banner subheaders via Jarallax, interactive counter stats, responsive drawers, and WOW.js entrance animations.
- **AJAX Working Contact Form**: Integrated client-side form validation (`js/validation-contact.js`) and PHP backend handler (`contact.php`).
- **Fully Responsive**: Optimized for desktop, tablet, and mobile devices.

---

## 📁 Project Structure

```text
Solar-main/
│
├── includes/                      # Reusable PHP modular components
│   ├── head.php                  # Document head, dynamic title, meta tags, CSS stylesheets
│   ├── header.php                # Topbar (contact/socials), logo, navbar, CTA button, mobile toggles
│   ├── subheader.php             # Inner page parallax banner with dynamic breadcrumbs
│   ├── prefooter.php             # 3-column contact quick-info bar (Phone, Hours, Email)
│   ├── footer.php                # Main footer widgets, quick links, copyright, overlay drawer
│   └── scripts.php               # Core JavaScript bundles and page-specific scripts
│
├── index.php                      # Homepage (Hero slider, services, stats, portfolio, reviews)
├── about.php                      # About Us (Company story, team portraits, vision & mission)
├── services.php                   # All Services overview (6 solar service cards)
├── service-single.php             # Single Service detailed case page
├── projects.php                   # Projects Gallery & Portfolio
├── project-single.php             # Single Project Case Study with carousel
├── contact.php                    # Contact page with form and POST processor
│
├── css/                           # Stylesheets
│   ├── bootstrap.min.css         # Bootstrap 5 grid and utility framework
│   ├── plugins.css               # Bundled plugin styles (Animate, OwlCarousel, etc.)
│   ├── swiper.css                # Swiper slider styling
│   ├── custom-swiper-1.css       # Custom Swiper configuration styling
│   ├── style.css                 # Master custom styling and responsive rules
│   └── colors/
│       └── scheme-1.css          # Primary color palette theme
│
├── js/                            # JavaScript files
│   ├── plugins.js                # Core plugins (Jarallax, WOW.js, Owl Carousel, etc.)
│   ├── designesia.js             # Main layout, sticky header, mobile nav, and animations
│   ├── swiper.js                 # Swiper touch slider engine
│   ├── custom-swiper-1.js        # Inner page carousel initializer
│   ├── custom-swiper-3.js        # Homepage hero slider initializer
│   ├── custom-marquee.js         # Smooth logo / partner marquee animation
│   └── validation-contact.js     # Form validation and AJAX submission script
│
├── images/                        # Optimized graphics and imagery (WebP & PNG)
│   ├── background/               # Parallax and banner hero backgrounds
│   ├── slider/                   # Homepage hero slider slides (1.webp, 2.webp)
│   ├── services/                 # Service showcase thumbnails (1.webp – 6.webp)
│   ├── industries/               # Industry sector photos (1.webp – 8.webp)
│   ├── projects/                 # Portfolio showcase images (1.webp – 6.webp)
│   ├── project-single/           # Gallery showcase images (1.webp – 4.webp)
│   ├── team/                     # Executive & engineering team portraits (1.webp – 4.webp)
│   ├── testimonial/              # Customer avatar portraits
│   ├── misc/                     # Graphic badges, shapes, and arrow icons
│   └── ui/                       # UI interface arrows and form elements
│
└── fonts/                         # Icon fonts (IcoFont, FontAwesome, ElegantFont, ET-Line)
```

---

## 🚀 Getting Started

### 1. Running with PHP Built-in Server
Open a terminal in the project directory and run:

```bash
php -S localhost:8000
```
Then open your browser and navigate to `http://localhost:8000`.

### 2. Running with XAMPP / WAMP / Laragon
1. Copy or move the `Solar-main` folder into your web server's root directory:
   - **XAMPP**: `C:\xampp\htdocs\solar`
   - **Laragon**: `C:\laragon\www\solar`
2. Start the **Apache** service from your control panel.
3. Open your browser and visit `http://localhost/solar`.

---

## ⚙️ Customization Guide

### 1. Updating Company Information & Contact Details
To update phone numbers, emails, addresses, and working hours across the entire website:
- **Header Topbar**: Edit `includes/header.php`
- **Pre-Footer Bar**: Edit `includes/prefooter.php`
- **Main Footer**: Edit `includes/footer.php`

### 2. Changing the Logo
Replace the logo files in `images/`:
- `images/logo-white.webp` (Header and footer white logo, recommended height: 35–45px)
- `images/logo-icon.webp` (Square mark/icon)
- `images/icon.webp` (Browser favicon, 16x16 / 32x32)

### 3. Changing Page Title and Meta Descriptions
At the top of each `.php` page, you can customize the metadata variables before the includes are called:

```php
<?php
$page_title = "About Us - Solaria Solar Energy";
$page_description = "Learn more about our mission and solar engineering team.";
$current_page = "about";
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/header.php';
?>
```

### 4. Contact Form Email Recipient
In `contact.php`, locate the `$recipient` variable and update it with your desired inbox:

```php
$recipient = "support@yourdomain.com";
```

---

## 📄 License & Credits

- **Framework**: Bootstrap 5
- **Icons**: IcoFont, Font Awesome
- **Sliders**: Swiper, Owl Carousel
- **Parallax**: Jarallax
- **Images**: High-resolution WebP solar and architectural photography

© 2025 Solaria. All rights reserved.
