<?php
// Handle form submission when requested via POST
if (($_SERVER["REQUEST_METHOD"] ?? '') === "POST") {
    $name = strip_tags(trim($_POST["name"] ?? ''));
    $email = filter_var(trim($_POST["email"] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"] ?? ''));
    $message = trim($_POST["message"] ?? '');

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please complete all required fields.";
        exit;
    }

    $recipient = "support@solaria.com";
    $subject = "New Contact Form Submission from " . $name;
    $email_content = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message\n";
    $email_headers = "From: $name <$email>";

    @mail($recipient, $subject, $email_content, $email_headers);
    http_response_code(200);
    echo "sent";
    exit;
}

$page_title = "Contact Us - Solaria Solar Energy";
$page_description = "Get in touch with our solar energy specialists for consultation and quotes.";
$current_page = "contact";
$extra_scripts = [
    'js/validation-contact.js'
];
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
                            <h1 class="mb-3 wow fadeInUp" data-wow-delay=".2s">Contact</h1>
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

                            <p>Whether you have a question, a suggestion, or just want to say hello, this is the place to do it. Please fill out the form below with your details and message, and we'll get back to you as soon as possible.</p>

                            <div class="row g-4 gx-5">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center fw-bold text-dark"><i class="icofont-clock-time me-2 id-color"></i><span>We're Open</span></div>
                                    Monday - Friday 08.00 - 18.00
                                </div>

                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center fw-bold text-dark"><i class="icofont-location-pin me-2 id-color"></i><span>Office Location</span></div>
                                    100 Solar Ave, San Diego, CA
                                </div>

                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center fw-bold text-dark"><i class="icofont-phone me-2 id-color"></i><span>Call Us Directly</span></div>
                                    +1 800 987 654
                                </div>

                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center fw-bold text-dark"><i class="icofont-envelope me-2 id-color"></i><span>Send a Message</span></div>
                                    support@solaria.com      
                                </div>
                            </div>



                        </div>

                        <div class="col-lg-6">
                            <div class="p-40 bg-light rounded-1">
                                <h3>Get In Touch</h3>
                                <form name="contactForm" id="contact_form" class="position-relative z1000" method="post" action="contact.php">
                                    <div class="row gx-4">
                                        <div class="col-lg-12 col-md-6 mb10">
                                            <div class="field-set">
                                                <span class="d-label">Name</span>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
                                            </div>

                                            <div class="field-set">
                                                <span class="d-label">Email</span>
                                                <input type="text" name="email" id="email" class="form-control" placeholder="Your Email" required>
                                            </div>

                                            <div class="field-set">
                                                <span class="d-label">Phone</span>
                                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone" required>
                                            </div>

                                            <div class="field-set mb20">
                                                <span class="d-label">Message</span>
                                                <textarea name="message" id="message" class="form-control" placeholder="Your Message" required></textarea>
                                            </div>
                                        </div>

                                    </div>
                                        
                                    
                                    
                                    <div id='submit' class="mt20">
                                        <input type='submit' id='send_message' value='Send Message' class="btn-main">
                                    </div>

                                    <div id="success_message" class='success text-light'>
                                        Your message has been sent successfully. Refresh this page if you want to send more messages.
                                    </div>
                                    <div id="error_message" class='error'>
                                        Sorry there was an error sending your form.
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
