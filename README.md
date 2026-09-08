# ☀️ AK Energies — Solar & Renewable Energy Website & CMS Admin Portal

[![PHP](https://img.shields.io/badge/PHP-8.0%2B-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7%2B%20%2F%208.0-4479A1?style=flat&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=flat&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![PHPMailer](https://img.shields.io/badge/PHPMailer-Integrated-blue)](https://github.com/PHPMailer/PHPMailer)
[![License](https://img.shields.io/badge/License-Proprietary-green)](#license--credits)

**AK Energies** is a full-featured, dynamic web application and Content Management System (CMS) purpose-built for solar energy contractors, green tech firms, and commercial renewable energy providers. 

The system combines a front-end customer-facing portal with a dedicated, password-protected administrative back-office to dynamically manage solar services, project portfolio case studies, multi-image galleries, and incoming quote requests.

---

## 📑 Table of Contents

- [Key Features](#-key-features)
  - [Customer-Facing Portal](#1-customer-facing-portal)
  - [Administrative CMS Portal](#2-administrative-cms-portal)
- [Technology Stack](#-technology-stack)
- [Project Directory Structure](#-project-directory-structure)
- [Database Schema & Architecture](#-database-schema--architecture)
- [Installation & Quick Start](#-installation--quick-start)
  - [Prerequisites](#prerequisites)
  - [Step-by-Step Setup in XAMPP](#step-by-step-setup-in-xampp)
  - [Alternative: PHP Built-in Server](#alternative-php-built-in-server)
- [Administrative Portal & Credentials](#-administrative-portal--credentials)
- [Email & SMTP Configuration](#-email--smtp-configuration)
- [Public Site Customization Guide](#-public-site-customization-guide)
- [Data Flow & Fallback Architecture](#-data-flow--fallback-architecture)
- [Troubleshooting & FAQs](#-troubleshooting--faqs)
- [License & Credits](#-license--credits)

---

## 🌟 Key Features

### 1. Customer-Facing Portal
- **Modular PHP Structure**: Global layout elements (`head`, `header`, `subheader`, `prefooter`, `footer`, `scripts`) are decoupled into `/includes/` for single-point editing.
- **Dynamic Database Integration**: Services and project case studies load directly from MySQL. If the database is unreachable, intelligent failover logic gracefully falls back to static seed data.
- **AJAX Working Contact & Quote Form**: Integrated client-side validation (`validation-contact.js`) communicating with `contact.php`. Inquiries are saved directly to MySQL and instant email notifications are dispatched via PHPMailer.
- **Interactive UI & Fluid Motion**:
  - Parallax banner backgrounds powered by **Jarallax**.
  - Hero slider and case study carousels built with **Swiper**.
  - Logo and client partner marquee with **custom-marquee.js**.
  - Scroll-triggered animations via **WOW.js** and **Animate.css**.
- **Performance Optimized**: Assets served in modern **WebP** photographic formats for rapid load times and Retina/4K clarity.
- **Fully Responsive**: Mobile-first architecture with custom off-canvas navigation and touch-optimized gestures.

### 2. Administrative CMS Portal (`/admin`)
- **Protected Dashboard**: Session-based authentication with `password_verify()` / `password_hash()` encryption.
- **Service Management**:
  - Add, edit, preview, and delete service offerings.
  - Image upload handler for listing cards and multi-layered detail headers.
  - Automatic URL-safe slug generation and status toggling (`active`/`inactive`).
- **Portfolio & Case Study Management**:
  - Full CRUD operations on projects.
  - Dynamic client goal checklists and measurable results builders.
  - Multiple image upload pipeline for gallery carousels.
- **Quote & Lead Management (`enquiries.php`)**:
  - Real-time review of client quote inquiries submitted via the public contact form.
  - Status progression workflow: `new` ➔ `contacted` ➔ `closed`.
  - Detailed modal inspection of customer messages, contact phone numbers, and timestamps.

---

## 🛠 Technology Stack

| Layer | Technology |
|---|---|
| **Server-Side Runtime** | PHP 7.4+ / PHP 8.0+ / PHP 8.2+ |
| **Database** | MySQL 5.7+ / MariaDB 10.4+ via PDO with Prepared Statements |
| **Email Delivery** | PHPMailer (SMTP with SSL/TLS support) |
| **Front-End Styling** | Bootstrap 5, Custom Vanilla CSS3, Color Scheme Overrides |
| **JavaScript Engines** | Vanilla JS, jQuery, Swiper.js, Jarallax, Owl Carousel, WOW.js |
| **Iconography** | IcoFont, Font Awesome, ET-Line, Elegant Icons |
| **Image Compression** | WebP & PNG |

---

## 📁 Project Directory Structure

```text
Solar-main/
│
├── admin/                             # Dedicated Administrative Back-Office
│   ├── config/
│   │   ├── auth.php                   # Authentication guard & session verification
│   │   ├── db.php                     # Admin PDO MySQL database connection
│   │   └── helpers.php                # Upload sanitizers, slug generators & flash helpers
│   ├── includes/
│   │   ├── header.php                 # Admin navigation bar & user profile dropdown
│   │   ├── sidebar.php                # Admin sidebar menu with dynamic active states
│   │   └── footer.php                 # Admin footer & JavaScript dependencies
│   ├── uploads/                       # Upload directory for services and project images
│   ├── database.sql                   # Clean MySQL database schema & seed admin user
│   ├── index.php                      # Admin router (redirects to dashboard or login)
│   ├── login.php                      # Admin login interface with CSRF-ready authentication
│   ├── logout.php                     # Session termination script
│   ├── dashboard.php                  # System metrics, counters & recent activity
│   ├── services.php                   # Service catalog management table
│   ├── service-add.php                # Create / Edit service interface
│   ├── service-details.php            # Detailed service preview
│   ├── service-delete.php             # Service deletion processor
│   ├── projects.php                   # Projects catalog management table
│   ├── project-add.php                # Create / Edit project interface with checklist builder
│   ├── project-details.php            # Detailed project preview
│   ├── project-delete.php             # Project deletion processor
│   └── enquiries.php                  # Lead & quote inquiry management
│
├── includes/                          # Public Website Modular Architecture
│   ├── db.php                         # Frontend PDO connection & data access layer
│   ├── mail.php                       # PHPMailer SMTP wrapper & notification handler
│   ├── head.php                       # HTML <head>, dynamic meta tags & stylesheet links
│   ├── header.php                     # Top contact bar, branding logo, navigation & quote CTA
│   ├── subheader.php                  # Hero banner subheader with dynamic breadcrumb trail
│   ├── slider.php                     # Modular homepage hero slider carousel
│   ├── prefooter.php                  # 3-column contact quick-info bar (Hours, Location, Phone)
│   ├── footer.php                     # Footer widgets, quick links, copyright & offcanvas drawer
│   └── scripts.php                    # Script bundles, plugins & custom JS initializers
│
├── PHPMailer/                         # PHPMailer library
│   └── src/
│       ├── Exception.php
│       ├── PHPMailer.php
│       └── SMTP.php
│
├── css/                               # Public Styling
│   ├── bootstrap.min.css              # Bootstrap 5 core grid & utilities
│   ├── plugins.css                    # Bundled animation & carousel styling
│   ├── swiper.css                     # Swiper touch slider styles
│   ├── style.css                      # Master custom design rules
│   └── colors/
│       └── scheme-1.css               # Primary solar theme color scheme
│
├── js/                                # Public Scripts
│   ├── designesia.js                  # Master layout engine, sticky nav & mobile drawer
│   ├── plugins.js                     # Core bundle (Jarallax, WOW, Owl, Counter)
│   ├── swiper.js                      # Touch slider engine
│   ├── custom-swiper-1.js             # Project single carousel initializer
│   ├── custom-swiper-3.js             # Homepage hero slider initializer
│   ├── custom-marquee.js              # Client logo marquee scroll engine
│   └── validation-contact.js          # Client AJAX validation & response processor
│
├── images/                            # WebP Visual Assets
│   ├── background/                    # Subheader & section parallax backgrounds
│   ├── slider/                        # High-resolution solar field slides
│   ├── services/                      # Service thumbnail illustrations
│   ├── industries/                    # Industry sector showcase photography
│   ├── projects/                      # Portfolio case study thumbnails
│   ├── project-single/                # Gallery slider images
│   ├── team/                          # Engineering & leadership portraits
│   └── testimonial/                   # Customer review avatars
│
├── fonts/                             # Icon fonts (IcoFont, FontAwesome, ET-Line)
│
├── index.php                          # Public Homepage
├── about.php                          # About Company, Mission & Team
├── services.php                       # Services Index (Database dynamic with fallback)
├── service-single.php                 # Service Detail View (Dynamic slug routing)
├── projects.php                       # Projects Portfolio (Database dynamic with fallback)
├── project-single.php                 # Project Case Study (Dynamic slug routing)
├── contact.php                        # Contact & Quote Page (Form handler + DB + Email)
└── README.md                          # Comprehensive documentation
```

---

## 🗄 Database Schema & Architecture

The system uses a relational MySQL database named `ak_energies`. The schema is provided in `admin/database.sql`.

```
                    ┌─────────────────────────┐
                    │         admins          │
                    ├─────────────────────────┤
                    │ id (PK)                 │
                    │ username                │
                    │ password (bcrypt hash)  │
                    │ full_name               │
                    │ created_at              │
                    └─────────────────────────┘

┌─────────────────────────┐                 ┌─────────────────────────┐
│        services         │                 │        projects         │
├─────────────────────────┤                 ├─────────────────────────┤
│ id (PK)                 │                 │ id (PK)                 │
│ title                   │                 │ title                   │
│ slug (UNIQUE)           │                 │ slug (UNIQUE)           │
│ short_description       │                 │ card_image              │
│ card_image              │                 │ intro_description       │
│ tag_label               │                 │ status (active/inactive)│
│ heading                 │                 │ sort_order              │
│ long_description        │                 │ created_at / updated_at │
│ detail_image1           │                 └───────────┬─────────────┘
│ detail_image2           │                             │ 1
│ status (active/inactive)│                             │
│ sort_order              │          ┌──────────────────┼──────────────────┐
│ created_at / updated_at │          │ 1..N             │ 1..N             │ 1..N
└─────────────────────────┘          ▼                  ▼                  ▼
                            ┌─────────────────┐┌─────────────────┐┌─────────────────┐
                            │  project_goals  ││ project_results ││ project_images  │
                            ├─────────────────┤├─────────────────┤├─────────────────┤
                            │ id (PK)         ││ id (PK)         ││ id (PK)         │
                            │ project_id (FK) ││ project_id (FK) ││ project_id (FK) │
                            │ goal_text       ││ result_text     ││ image_path      │
                            │ sort_order      ││ sort_order      ││ sort_order      │
                            └─────────────────┘└─────────────────┘└─────────────────┘

┌─────────────────────────┐
│        enquiries        │
├─────────────────────────┤
│ id (PK)                 │
│ name                    │
│ email                   │
│ phone                   │
│ service_interested      │
│ message                 │
│ status (new/cont/close) │
│ created_at              │
└─────────────────────────┘
```

### Table Breakdown
1. **`admins`**: Stores administrative credentials with bcrypt password hashes.
2. **`services`**: Stores service cards and long-form descriptions with multi-image support.
3. **`projects`**: Stores portfolio projects, case study descriptions, and display sorting.
4. **`project_goals`**: One-to-Many relationship with `projects` storing bulleted client goals.
5. **`project_results`**: One-to-Many relationship with `projects` storing measurable impact metrics.
6. **`project_images`**: One-to-Many relationship with `projects` holding carousel gallery photo paths.
7. **`enquiries`**: Logs every quote request submitted through the public contact form.

---

## 🚀 Installation & Quick Start

### Prerequisites
- **Web Server**: Apache or Nginx with PHP 7.4 or higher (PHP 8.1+ recommended).
- **Database**: MySQL 5.7+ or MariaDB 10.4+.
- **PHP Extensions**: `pdo`, `pdo_mysql`, `openssl`, `mbstring`, `fileinfo`.
- **Environment**: [XAMPP](https://www.apachefriends.org/), [WampServer](https://www.wampserver.com/), [Laragon](https://laragon.org/), or Docker.

---

### Step-by-Step Setup in XAMPP

#### 1. Place Project in Web Root
Clone or extract the repository folder into your XAMPP `htdocs` directory:
```text
C:\xampp\htdocs\Solar-main
```

#### 2. Create MySQL Database
1. Open your browser and navigate to phpMyAdmin: `http://localhost/phpmyadmin`
2. Click **New** in the left sidebar.
3. Name the database: `ak_energies`
4. Collation: `utf8mb4_unicode_ci` (or `utf8mb4_general_ci`).
5. Click **Create**.

#### 3. Import Database Schema
1. Select the newly created `ak_energies` database in phpMyAdmin.
2. Navigate to the **Import** tab at the top.
3. Click **Choose File** and browse to:
   ```text
   C:\xampp\htdocs\Solar-main\admin\database.sql
   ```
4. Click **Import** at the bottom of the page. All tables and default records will be created.

#### 4. Configure Database Credentials
Verify that the database configuration in both files matches your local MySQL server setup:

- **Frontend Configuration**: [`includes/db.php`](file:///c:/xampp/htdocs/Solar-main/includes/db.php)
  ```php
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'ak_energies');
  define('DB_USER', 'root');
  define('DB_PASS', ''); // Leave empty for default XAMPP
  ```

- **Admin Panel Configuration**: [`admin/config/db.php`](file:///c:/xampp/htdocs/Solar-main/admin/config/db.php)
  ```php
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'ak_energies');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('BASE_URL', 'http://localhost/Solar-main/admin');
  ```
  *(Note: Adjust `BASE_URL` if your project folder name or port differs).*

#### 5. Verify Folder Permissions
Ensure the upload directory is writable by your web server:
```text
admin/uploads/
```
*(On Windows/XAMPP, write permissions are usually granted by default. On Linux, run `chmod -R 775 admin/uploads`).*

#### 6. Access the Application
- **Public Portal**: `http://localhost/Solar-main/`
- **Admin Control Panel**: `http://localhost/Solar-main/admin/`

---

### Alternative: PHP Built-in Server

You can also run the public application directly with PHP's built-in web server:
```bash
cd c:\xampp\htdocs\Solar-main
php -S localhost:8000
```
Then access `http://localhost:8000` in your web browser.

---

## 🔐 Administrative Portal & Credentials

The administrative control panel is located at `/admin/`.

### Default Credentials
| Field | Value |
|---|---|
| **Login URL** | `http://localhost/Solar-main/admin/login.php` |
| **Username** | `admin` |
| **Default Password** | `admin123` |

> [!IMPORTANT]
> **Security Notice**: Immediately change the default admin password in production or generate a new bcrypt hash using PHP's `password_hash('your_new_password', PASSWORD_DEFAULT)`.

### Admin Capabilities
- **Overview Dashboard**: View real-time KPI cards for Active Services, Completed Projects, and Unread Inquiries.
- **Service Editor**: Add high-impact solar services with custom subtitles, overview cards, and dual-layer hero imagery.
- **Project Case Study Builder**: Add project specifications, goals, bulleted impact results, and multi-photo carousel galleries.
- **Lead Tracker**: View client contact details, phone numbers, timestamps, and transition inquiries between `new`, `contacted`, and `closed`.

---

## ✉️ Email & SMTP Configuration

Contact form submissions in `contact.php` are processed through PHPMailer. SMTP parameters are managed inside [`includes/mail.php`](file:///c:/xampp/htdocs/Solar-main/includes/mail.php).

```php
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', PHPMailer::ENCRYPTION_STARTTLS);
define('SMTP_AUTH', true);
define('SMTP_USER', 'your-email@gmail.com');
define('SMTP_PASS', 'your-16-character-app-password');
define('MAIL_FROM_EMAIL', 'your-email@gmail.com');
define('MAIL_FROM_NAME', 'AK Energies Website');
define('ADMIN_NOTIFICATION_EMAIL', 'admin@akenergies.com');
```

### Gmail Configuration Notes
1. If using Gmail, enable **2-Step Verification** in your Google Account.
2. Generate a 16-character **App Password** under *Security ➔ App Passwords*.
3. Paste the generated key into `SMTP_PASS`.

---

## 🎨 Public Site Customization Guide

### 1. Global Contact & Brand Details
Update brand phone numbers, office location, and hours in these three centralized include files:
- **Header & Topbar**: [`includes/header.php`](file:///c:/xampp/htdocs/Solar-main/includes/header.php)
- **Pre-Footer Strip**: [`includes/prefooter.php`](file:///c:/xampp/htdocs/Solar-main/includes/prefooter.php)
- **Main Footer**: [`includes/footer.php`](file:///c:/xampp/htdocs/Solar-main/includes/footer.php)

### 2. Logos & Favicons
Replace the graphic assets in `images/`:
- `images/logo-white.webp`: Header and footer light logo (recommended height: 35–45px).
- `images/logo-icon.webp`: Square branding icon.
- `images/icon.webp`: Browser favicon.

### 3. Page Titles & SEO Metadata
Each page defines its title, description, and active menu slug prior to loading the includes:
```php
<?php
$page_title = "Solar Services - AK Energies";
$page_description = "Explore commercial and residential solar installation services.";
$current_page = "services";
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/header.php';
?>
```

---

## 🔄 Data Flow & Fallback Architecture

To guarantee 100% uptime and resilience against database misconfigurations:

```
[User Request] 
       │
       ▼
[Page Controller (e.g. services.php)]
       │
       ▼
[includes/db.php -> get_db()]
       ├───> (Database Connected) ───► Fetch records from MySQL
       │
       └───> (Connection Failed) ───► Fall back seamlessly to default array
                                       Log warning to server error log
                                       Serve complete HTML layout without crash
```

- If MySQL is running and tables are populated, content is loaded dynamically.
- If MySQL is down, the frontend seamlessly displays curated fallback cards, ensuring zero visible disruption to visitors.

---

## ❓ Troubleshooting & FAQs

### 1. "Database connection failed" Error in Admin
- Confirm Apache and MySQL are running in XAMPP/WAMP.
- Ensure the database `ak_energies` exists in phpMyAdmin and `admin/database.sql` was imported.
- Double-check password settings in `admin/config/db.php` (`DB_PASS` is empty `""` by default in XAMPP).

### 2. Images uploaded in Admin are not showing on the frontend
- Check that the `admin/uploads/` directory exists and has write permissions.
- Verify `BASE_URL` in `admin/config/db.php` matches your local server path.
- The helper `get_image_url()` in `includes/db.php` checks both `admin/uploads/` and root `images/`.

### 3. Contact Form shows "Error sending message"
- Ensure credentials in `includes/mail.php` are accurate.
- Check firewall settings for outbound connection on SMTP port 587 or 465.
- Note that inquiries are always logged to the `enquiries` database table even if email delivery encounters network timeouts.

---

## 📄 License & Credits

- **Bootstrap 5**: Responsive layout framework ([MIT License](https://github.com/twbs/bootstrap/blob/main/LICENSE))
- **Swiper**: Modern mobile touch slider ([MIT License](https://swiperjs.com/))
- **Jarallax**: Parallax scroll effects ([MIT License](https://github.com/nk-o/jarallax))
- **PHPMailer**: Email sending library ([LGPL-2.1](https://github.com/PHPMailer/PHPMailer/blob/master/LICENSE))
- **Icons**: IcoFont, Font Awesome
- **Photography**: Commercial renewable energy and solar array photography in WebP format.

---

**© 2025 AK Energies. All rights reserved.**
