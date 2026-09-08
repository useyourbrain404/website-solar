<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/mail.php';

// Handle form submission when requested via POST
if (($_SERVER["REQUEST_METHOD"] ?? '') === "POST") {
    $name    = strip_tags(trim($_POST["name"] ?? ''));
    $email   = filter_var(trim($_POST["email"] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone   = strip_tags(trim($_POST["phone"] ?? ''));
    $service = strip_tags(trim($_POST["service_interested"] ?? 'General Consultation'));
    $message = trim($_POST["message"] ?? '');

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please complete all required fields with a valid email.";
        exit;
    }

    // Save inquiry to MySQL database
    save_enquiry($name, $email, $phone, $service, $message);

    // Send email notification via PHPMailer
    send_contact_email($name, $email, $phone, $message, $service);

    http_response_code(200);
    echo "sent";
    exit;
}

$page_title = "Contact Us - AK Energies";
$page_description = "Get in touch with our solar energy specialists for consultation and quotes.";
$current_page = "contact";
$extra_scripts = [
    'js/validation-contact.js?v=2'
];

$selected_service = strtolower(trim($_GET['service'] ?? $_GET['id'] ?? ''));

require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/header.php';
?>

        <!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>

            <section id="subheader" class="bg-dark text-light relative jarallax">
                <img src="images/background/6.webp" class="jarallax-img" alt="">
                <div class="container relative z-2">
                    <div class="row gy-4 gx-5 align-items-center">
                        <div class="col-lg-12">
                            <div class="spacer-double sm-hide"></div>
                            <h5 class="wow fadeInUp">Power Your Future with Clean Energy</h5>
                            <h1 class="mb-3 wow fadeInUp" data-wow-delay=".2s">Contact &amp; Get a Quote</h1>
                            <div class="border-bottom mb-3"></div>
                            <ul class="crumb wow fadeInUp">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Contact</li>
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
                        <div class="col-lg-6">
                            <div class="subtitle">Get In Touch</div>
                            <h2 class="wow fadeInUp">We are always ready to help you and answer your questions</h2>

                            <p>Whether you have questions about rooftop solar, commercial projects, government subsidies, or need an on-site energy audit, our engineering team is here to assist you.</p>

                            <div class="row g-4 gx-5 mt-2">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center fw-bold text-dark mb-1"><i class="icofont-clock-time me-2 id-color fs-18"></i><span>We're Open</span></div>
                                    <span class="text-muted">Monday - Saturday 08.00 - 18.00</span>
                                </div>

                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center fw-bold text-dark mb-1"><i class="icofont-location-pin me-2 id-color fs-18"></i><span>Office Location</span></div>
                                    <a href="https://maps.google.com/?q=100+Solar+Ave,+San+Diego,+CA" target="_blank" rel="noopener noreferrer" class="contact-click-link text-muted">100 Solar Ave, San Diego, CA</a>
                                </div>

                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center fw-bold text-dark mb-1"><i class="icofont-phone me-2 id-color fs-18"></i><span>Call Us Directly</span></div>
                                    <a href="tel:+1800987654" class="contact-click-link fw-bold text-dark fs-15">+1 800 987 654</a>
                                </div>

                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center fw-bold text-dark mb-1"><i class="icofont-envelope me-2 id-color fs-18"></i><span>Send a Message</span></div>
                                    <a href="mailto:support@akenergies.com" class="contact-click-link text-muted">support@akenergies.com</a>
                                </div>
                            </div>

                            <div class="p-4 mt-4 bg-light rounded-1 border-start border-4 border-success">
                                <h5 class="mb-1 text-dark"><i class="fa-brands fa-whatsapp text-success me-2"></i> Prefer WhatsApp?</h5>
                                <p class="mb-2 fs-14 text-muted">Connect directly with our senior solar engineer for quick quotes and instant project inquiries.</p>
                                <a href="https://wa.me/1800987654?text=Hi%20AK%20Energies%2C%20I%20would%20like%20a%20solar%20quote" target="_blank" rel="noopener noreferrer" class="btn-main btn-line fx-slide">
                                    <span>Chat on WhatsApp &rarr;</span>
                                </a>
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="p-40 bg-light rounded-1 shadow-sm">
                                <h3>Request a Free Quote</h3>
                                <p class="text-muted mb-4 fs-14">Fill out your project details and our team will get back to you within 24 hours.</p>

                                <?php if (isset($_GET['sent'])): ?>
                                    <div class="alert alert-success d-flex align-items-center mb-4" id="refresh_success" style="background:#67812F; color:#ffffff; border:none; padding:15px 18px; border-radius:8px; font-size:14.5px;">
                                        <i class="icofont-check-circled me-2" style="font-size:22px; flex-shrink:0;"></i>
                                        <div>
                                            <strong>Thank You!</strong> Your inquiry has been sent successfully. Our team will contact you shortly.
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <form name="contactForm" id="contact_form" class="position-relative z1000" method="post" action="contact.php">
                                    <div class="row gx-4">
                                        <div class="col-lg-12 mb15">
                                            <div class="field-set">
                                                <label class="d-label" for="name">Your Name *</label>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="John Doe" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb15">
                                            <div class="field-set">
                                                <label class="d-label" for="email">Email Address *</label>
                                                <input type="email" name="email" id="email" class="form-control" placeholder="john@example.com" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb15">
                                            <div class="field-set">
                                                <label class="d-label" for="phone">Phone Number *</label>
                                                <input type="tel" name="phone" id="phone" class="form-control" placeholder="+1 (555) 000-0000" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb15">
                                            <div class="field-set">
                                                <label class="d-label" for="service_interested">Service Interested In</label>
                                                <select name="service_interested" id="service_interested" class="form-select ak-select">
                                                    <option value="General Consultation" <?= ($selected_service === '' || $selected_service === 'general') ? 'selected' : '' ?>>General Consultation / Quote</option>
                                                    <option value="Solar Rooftop Systems" <?= (strpos($selected_service, 'rooftop') !== false) ? 'selected' : '' ?>>Solar Rooftop Systems</option>
                                                    <option value="Solar EPC Utility Grid Projects" <?= (strpos($selected_service, 'grid') !== false || strpos($selected_service, 'epc') !== false) ? 'selected' : '' ?>>Solar EPC Utility Grid Projects</option>
                                                    <option value="Solar Farms Solutions" <?= (strpos($selected_service, 'farm') !== false) ? 'selected' : '' ?>>Solar Farms Solutions</option>
                                                    <option value="Energy Auditing" <?= (strpos($selected_service, 'audit') !== false) ? 'selected' : '' ?>>Energy Auditing &amp; Consultation</option>
                                                    <option value="Solar Lighting Solutions" <?= (strpos($selected_service, 'lighting') !== false) ? 'selected' : '' ?>>Solar Lighting Solutions</option>
                                                    <option value="Power Trading" <?= (strpos($selected_service, 'power') !== false || strpos($selected_service, 'trading') !== false) ? 'selected' : '' ?>>Power Trading</option>
                                                    <option value="Commercial &amp; Industrial Solar" <?= (strpos($selected_service, 'commercial') !== false || strpos($selected_service, 'industrial') !== false) ? 'selected' : '' ?>>Commercial &amp; Industrial Solar</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb20">
                                            <div class="field-set">
                                                <label class="d-label" for="message">Your Message / Project Details *</label>
                                                <textarea name="message" id="message" class="form-control" rows="4" placeholder="Tell us about your property, estimated monthly power bill, or energy requirements..." required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    <div id='submit' class="mt10">
                                        <button type='submit' id='send_message' class="btn-main fx-slide w-100 py-3 text-center">
                                            <span>Send Message &amp; Request Quote</span>
                                        </button>
                                    </div>

                                    <div id="success_message" class='success text-light' style="display:none; padding:15px 18px; border-radius:8px; background:#67812F; font-size:14.5px; margin-top:15px;">
                                        <i class="icofont-check-circled me-2"></i> <strong>Thank You!</strong> Your message has been sent successfully. Refreshing...
                                    </div>
                                    <div id="error_message" class='error' style="display:none; padding:14px 18px; border-radius:8px; background:#dc2626; color:#ffffff; font-size:14px; margin-top:15px;">
                                        Sorry, there was an error sending your message. Please check all fields and try again.
                                    </div>
                                </form>
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
