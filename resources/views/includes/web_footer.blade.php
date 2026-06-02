<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap');

    /* --- Scoped Modern Footer Styles --- */
    .site-footer {
        display: block;
        width: 100%;
        background-color: #150713; /* Deep Plum */
        /* Built-in subtle glow without absolute positioning */
        background-image: radial-gradient(circle at top left, rgba(231, 84, 128, 0.05) 0%, transparent 60%);
        color: #a895a2; /* Soft Mauve text */
        font-family: 'Poppins', sans-serif;
        border-top: 2px solid rgba(231, 84, 128, 0.2); /* Pink top line */
        margin-top: auto;
        position: relative;
        z-index: 10;
    }

    /* --- Footer Top --- */
    .footer-top {
        padding-top: 80px;
        padding-bottom: 30px;
    }

    .footer-brand .footer-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 2.2rem;
        color: #e75480; /* Pink Icon */
    }

    .footer-brand .footer-logo-text {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: #ffffff;
        letter-spacing: 0.5px;
    }

    .footer-description {
        font-size: 0.95rem;
        line-height: 1.8;
        font-weight: 300;
        margin-top: 15px;
    }

    /* Social Icons */
    .footer-social {
        display: flex;
        gap: 12px;
    }

    .social-link {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        background-color: #e75480;
        border-color: #e75480;
        transform: translateY(-4px);
        color: #ffffff;
    }

    /* Column Headings */
    .footer-heading {
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 25px;
        padding-bottom: 12px;
        position: relative;
    }

    .footer-heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 35px;
        height: 2px;
        background-color: #e75480;
        border-radius: 2px;
    }

    /* Quick Links */
    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 12px;
    }

    .footer-links a {
        color: #a895a2;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        font-weight: 300;
    }

    .footer-links a::before {
        content: '›';
        font-size: 1.3rem;
        color: #e75480;
        margin-right: 8px;
        transition: transform 0.3s ease;
    }

    .footer-links a:hover {
        color: #e75480;
    }

    .footer-links a:hover::before {
        transform: translateX(4px);
    }

    /* Newsletter Form */
   .footer-newsletter-text {
        font-size: 0.95rem;
        font-weight: 300;
        margin-bottom: 15px;
    }

    .newsletter-form .input-group {
        background: rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 50px;
        padding: 4px;
        display: flex;
        flex-wrap: nowrap !important; /* Forces the button to stay on the same line */
        align-items: center;
        transition: border-color 0.3s ease;
    }

    .newsletter-form .input-group:focus-within {
        border-color: rgba(231, 84, 128, 0.5);
    }

    .newsletter-form .form-control {
        flex: 1 1 auto; /* Allows the input to shrink and grow perfectly to fill space */
        width: auto; /* Overrides Bootstrap's 100% width that causes wrapping */
        background: transparent;
        border: none;
        color: #ffffff;
        padding: 10px 15px;
        box-shadow: none;
        font-size: 0.95rem;
        font-weight: 300;
    }

    .newsletter-form .form-control:focus {
        outline: none;
        background: transparent;
        color: #ffffff;
        box-shadow: none;
    }

    .newsletter-form .form-control::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    .btn-newsletter {
        flex: 0 0 auto; /* Prevents the button from shrinking or growing */
        background-color: #e75480;
        color: #ffffff;
        border: none;
        border-radius: 50px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .btn-newsletter:hover {
        background-color: #d6406c;
        color: #ffffff;
    }

    /* Privacy Checkbox */
    .form-check-label {
        font-size: 0.8rem;
        color: #a895a2;
        font-weight: 300;
    }

    /* Contact Info */
    .footer-contact .contact-item {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.95rem;
        font-weight: 300;
    }

    .footer-contact .contact-item i {
        color: #e75480;
        font-size: 1.1rem;
    }

    .footer-contact .contact-item a {
        color: #a895a2;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-contact .contact-item a:hover, .footer-contact .contact-item span:hover {
        color: #ffffff;
    }

    /* --- Footer Middle --- */
    .footer-middle {
        padding: 40px 0;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .app-download h5, .footer-awards h5 {
        font-family: 'Playfair Display', serif;
        color: #ffffff;
        font-size: 1.2rem;
        margin-bottom: 20px;
    }

    /* App Buttons */
    .app-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .app-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 8px 20px;
        border-radius: 12px;
        color: #ffffff;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .app-btn i { font-size: 1.6rem; }

    .app-text { display: flex; flex-direction: column; }
    .app-text .small { font-size: 0.65rem; text-transform: uppercase; opacity: 0.7; }
    .app-text .large { font-size: 1.05rem; font-weight: 500; }

    .app-btn:hover {
        background: rgba(231, 84, 128, 0.1);
        border-color: #e75480;
        transform: translateY(-2px);
        color: #ffffff;
    }

    /* Awards */
    .awards-grid {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .award-item {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #D4AF37; /* Gold */
        background: rgba(212, 175, 55, 0.05);
        border: 1px solid rgba(212, 175, 55, 0.2);
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
    }

    /* --- Footer Bottom --- */
    .footer-bottom {
        background-color: #0a0409; /* Pitch black */
        padding: 20px 0;
        font-size: 0.9rem;
        font-weight: 300;
    }

    .copyright { margin: 0; }

    .footer-legal {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 20px;
        flex-wrap: wrap;
    }

    .legal-link {
        color: #a895a2;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .legal-link:hover { color: #e75480; }

    .back-to-top {
        background: transparent;
        border: 1px solid #e75480;
        color: #e75480;
        border-radius: 6px;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: 0.3s ease;
        margin-left: 10px;
    }

    .back-to-top:hover {
        background: #e75480;
        color: #ffffff;
    }

    /* Responsive Defaults */
    @media (max-width: 991px) {
        .footer-top { padding-top: 50px; }
        .footer-legal { justify-content: flex-start; margin-top: 15px; }
    }
    
    @media (max-width: 768px) {
        .app-buttons { flex-direction: column; }
        .footer-bottom { text-align: center; }
        .footer-legal { justify-content: center; }
    }
</style>

<footer class="site-footer">
    <div class="footer-top pt-0">
        <div class="container pt-4">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="footer-brand">
                        <div class="footer-logo mb-3">
                            <i class="bi bi-heart-fill"></i>
                            <span class="footer-logo-text">HappilyWeds</span>
                        </div>
                        <p class="footer-description">
                            Your trusted AI enabled partner in creating beautiful, memorable weddings. 
                            From planning to inspiration, we're here for every step of your journey.
                        </p>
                        <div class="footer-social mt-4">
                            <a href="#" class="social-link" aria-label="Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="Pinterest">
                                <i class="bi bi-pinterest"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="TikTok">
                                <i class="bi bi-tiktok"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="YouTube">
                                <i class="bi bi-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 mb-5">
                    <h4 class="footer-heading">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="/">Home</a></li>
                        <li><a href="/planning">Wedding Planning</a></li>
                        <li><a href="/success-stories">Inspiration</a></li>
                        <li><a href="/real-weddings">Real Weddings</a></li>
                        <li><a href="/blog">Blog</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-5">
                    <h4 class="footer-heading">Planning Tools</h4>
                    <ul class="footer-links">
                        <li><a href="/contact">Wedding Checklist</a></li>
                        <li><a href="/contact">Budget Calculator</a></li>
                        <li><a href="/contact">Guest List Manager</a></li>
                        <li><a href="/contact">Seating Chart Tool</a></li>
                        <li><a href="/contact">Timeline Planner</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-5">
                    <h4 class="footer-heading">Stay Updated</h4>
                    <p class="footer-newsletter-text">
                        Get wedding tips, trends, and inspiration delivered to your inbox.
                    </p>
                    
                    <form class="newsletter-form mt-3" action="/newsletter/subscribe" method="POST">
                        <div class="input-group">
                            <input type="email" 
                                   name="email" 
                                   class="form-control" 
                                   placeholder="Your email address" 
                                   aria-label="Email address"
                                   required>
                            <button class="btn btn-newsletter" type="submit">
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="privacyCheck" checked>
                            <label class="form-check-label" for="privacyCheck">
                                I agree to the privacy policy
                            </label>
                        </div>
                    </form>

                    <div class="footer-contact mt-4">
                        <div class="contact-item mb-2">
                            <i class="bi bi-envelope me-2"></i>
                            <a href="mailto:info@happilyweds.com">info@happilyweds.com</a>
                        </div>
                        <div class="contact-item mb-2">
                            <i class="bi bi-telephone me-2"></i>
                            <a href="tel:+918557856150">(+91) 88728-03189</a>
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-geo-alt me-2"></i>
                            <span>Chandigarh road, Ludhiana</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="app-download">
                        <h5 class="mb-3">Download Our App <span>(Coming Soon)</span> </h5>
                        <div class="app-buttons">
                            <a href="#" class="app-btn app-store">
                                <i class="bi bi-apple"></i>
                                <div class="app-text">
                                    <span class="small">Download on the</span>
                                    <span class="large">App Store</span>
                                </div>
                            </a>
                            <a href="#" class="app-btn google-play">
                                <i class="bi bi-google-play"></i>
                                <div class="app-text">
                                    <span class="small">Get it on</span>
                                    <span class="large">Google Play</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer-awards">
                        <h5 class="mb-3">Awards & Recognition</h5>
                        <div class="awards-grid">
                            <div class="award-item">
                                <i class="bi bi-award-fill"></i>
                                <span>Best Wedding Website 2023</span>
                            </div>
                            <div class="award-item">
                                <i class="bi bi-star-fill"></i>
                                <span>4.9/5 Customer Rating</span>
                            </div>
                            <div class="award-item">
                                <i class="bi bi-shield-check"></i>
                                <span>Trusted Vendor Network</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <p class="copyright">
                        &copy; 2026 HappilyWeds.com. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="footer-legal">
                        <a href="{{ url('/privacy-policy') }}" class="legal-link">Privacy Policy</a>
                        <a href="/terms-of-service" class="legal-link">Terms of Service</a>
                        <a href="/cookies" class="legal-link">Cookie Policy</a>
                        <a href="/sitemap" class="legal-link">Sitemap</a>
                        <button class="back-to-top" aria-label="Back to top" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">
                            <i class="bi bi-arrow-up"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>