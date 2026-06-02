<style>
    /* --- Matrimony Unique "Blooming Petal" Features Section --- */
    /* Color Palette: 
       Primary Matrimony Pink: #e75480
       Soft Rose Gradient: #ff758c
       Deep Plum (Text): #2d1b2e
       Soft Blush (Background): #fffafb
    */
    
    .features-section {
        padding: 120px 0;
        background-color: #fffafb; 
    }

    .section-title {
        text-align: center;
        margin-bottom: 90px; /* Increased to account for floating icons */
    }

    .section-title h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        font-weight: 800;
        color: #2d1b2e;
        margin-bottom: 20px;
        position: relative;
        display: inline-block;
    }

    /* Elegant Dual-Dot Underline */
    .section-title h2::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 2px;
        background: #e75480;
    }
    .section-title h2::before {
        content: '◆';
        position: absolute;
        bottom: -19px;
        left: 50%;
        transform: translateX(-50%);
        color: #e75480;
        font-size: 12px;
        background: #fffafb;
        padding: 0 10px;
        z-index: 2;
    }

    .section-title p {
        font-family: 'Poppins', sans-serif;
        font-size: 1.15rem;
        color: #6b5b6b;
        max-width: 700px;
        margin: 0 auto;
    }

    /* --- Unique Petal Shape Cards --- */
    .feature-card {
        background: #ffffff;
        /* Asymmetrical rounded corners for a natural, petal-like look */
        border-radius: 40px 12px 40px 12px; 
        padding: 55px 30px 35px;
        text-align: center;
        border: 1px solid rgba(231, 84, 128, 0.05);
        box-shadow: 0 15px 35px rgba(45, 27, 46, 0.05); 
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;
        margin-top: 30px; /* Creates space for the floating icon */
    }

    /* Hover effect: The petal shape morphs to the opposite corners! */
    .feature-card:hover {
        transform: translateY(-10px);
        border-radius: 12px 40px 12px 40px; 
        box-shadow: 0 25px 50px rgba(231, 84, 128, 0.15);
        border-color: rgba(231, 84, 128, 0.2);
    }

    /* --- Floating Cutout Icons --- */
    .feature-icon {
        position: absolute;
        top: -40px; /* Floats half inside, half outside the card */
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #e75480, #ff758c);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: #ffffff;
        /* Thick border matching the section background creates a "cutout" illusion */
        border: 8px solid #fffafb; 
        box-shadow: 0 10px 20px rgba(231, 84, 128, 0.2);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 2;
    }

    /* Icon transforms elegantly on hover */
    .feature-card:hover .feature-icon {
        transform: translateX(-50%) translateY(-8px) rotateY(180deg);
        box-shadow: 0 15px 25px rgba(231, 84, 128, 0.4);
        background: linear-gradient(135deg, #ff758c, #e75480);
    }

    /* Soft glowing ambient circle inside the bottom right of the card */
    .feature-card::before {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 120px;
        height: 120px;
        background: radial-gradient(circle, rgba(231,84,128,0.06) 0%, transparent 70%);
        border-radius: 50%;
        transition: all 0.5s ease;
        pointer-events: none;
    }

    .feature-card:hover::before {
        transform: scale(2);
        background: radial-gradient(circle, rgba(231,84,128,0.1) 0%, transparent 70%);
    }

    /* --- Card Typography --- */
    .feature-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.45rem;
        font-weight: 700;
        color: #2d1b2e;
        margin-bottom: 15px;
        position: relative;
        z-index: 2;
    }

    .feature-card p {
        font-family: 'Poppins', sans-serif;
        font-size: 0.95rem;
        color: #6b5b6b;
        line-height: 1.7;
        margin: 0;
        position: relative;
        z-index: 2;
    }

    /* --- Responsive Adjustments --- */
    @media (max-width: 991px) {
        .feature-card { margin-top: 40px; margin-bottom: 20px; }
    }
    @media (max-width: 768px) {
        .section-title h2 { font-size: 2.2rem; }
        .features-section { padding: 80px 0; }
        .feature-card { padding: 45px 20px 30px; }
    }
</style>

<section class="features-section">
    <div class="container">
        <div class="section-title">
            <h2>Why Choose HappilyWeds?</h2>
            <p>Discover why we're India's most trusted premium matrimonial platform</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3>Verified Profiles</h3>
                    <p>All profiles are manually verified to ensure complete authenticity and security.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-heart-pulse"></i> 
                    </div>
                    <h3>AI-Powered Smart Matching</h3>
                    <p>Advanced AI algorithms analyze your lifestyle and preferences to find highly compatible matches.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <h3>Secure Chat</h3>
                    <p>A private messaging system built with end-to-end privacy and security.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-phone"></i>
                    </div>
                    <h3>Mobile App</h3>
                    <p>Stay connected on the go with our beautifully designed mobile application.</p>
                </div>
            </div>
        </div>
    </div>
    
</section>
<section>
    <img src="{{ asset('public/assets/images/feature-bg.png') }}" alt="Feature Background" class="img-fluid" style="width: 100%;">
</section>