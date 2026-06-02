<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap');

    /* --- Scoped CTA Section --- */
    .cta-section {
        position: relative;
        padding: 120px 20px;
        /* Custom gradient: Dark Plum (#150713) down to Matrimony Pink (#e75480) */
        background-color: #150713;
        background-image: linear-gradient(to bottom, #150713 0%, #e75480 100%);
        color: #ffffff;
        text-align: center;
        overflow: hidden;
        font-family: 'Poppins', sans-serif;
        border-top: 1px solid rgba(231, 84, 128, 0.2);
        border-bottom: 1px solid rgba(231, 84, 128, 0.2);
    }

    /* Ambient floating glowing orbs */
    .cta-section::before,
    .cta-section::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        z-index: 1;
        pointer-events: none;
    }

    .cta-section::before {
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.08); /* Soft top highlight */
        top: -50px;
        right: 10%;
    }

    .cta-section::after {
        width: 400px;
        height: 400px;
        background: rgba(212, 175, 55, 0.15); /* Warm gold bottom glow */
        bottom: -150px;
        left: 20%;
    }

    /* --- Interlocking Two-Hearts Watermark on Left --- */
    .left-side-hearts {
        position: absolute;
        left: -100px; /* Peeks in from the edge */
        top: 50%;
        transform: translateY(-50%) rotate(-15deg);
        width: 400px;
        height: auto;
        opacity: 0.12; /* Subtle watermark effect */
        mix-blend-mode: screen; 
        fill: none;
        stroke: #ffffff; /* White stroke stands out nicely against the dark BG */
        stroke-width: 4px;
        stroke-linecap: round;
        stroke-linejoin: round;
        z-index: 0;
        pointer-events: none;
    }

    .cta-section .container {
        position: relative;
        z-index: 2;
    }

    .cta-section .cta-content {
        max-width: 750px;
        margin: 0 auto;
    }

    /* --- Typography --- */
    .cta-section .cta-title {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 25px;
        line-height: 1.2;
        /* Glow to make it stand out on dark BG */
        text-shadow: 0 0 20px rgba(255, 255, 255, 0.1), 0 4px 30px rgba(0, 0, 0, 0.4);
    }

    .cta-section .cta-subtitle {
        font-size: 1.15rem;
        font-weight: 300;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 50px;
        line-height: 1.7;
    }

    /* --- The Call To Action Button --- */
    .cta-section .btn-cta {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        background: #ffffff;
        color: #e75480; /* Matrimony Pink Text */
        padding: 18px 45px;
        border-radius: 50px;
        font-size: 1.15rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }

    .cta-section .btn-cta:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4), 0 0 30px rgba(255, 255, 255, 0.4);
        color: #150713; /* Changes to dark plum on hover */
    }

    /* Subtle Heartbeat Animation for the Icon */
    .cta-section .btn-cta i {
        font-size: 1.3rem;
        color: #e75480;
        animation: heartbeat 2s infinite ease-in-out;
    }

    @keyframes heartbeat {
        0%, 100% { transform: scale(1); }
        15% { transform: scale(1.25); }
        30% { transform: scale(1); }
        45% { transform: scale(1.25); }
        60% { transform: scale(1); }
    }

    /* --- Trust Badges (Bottom Text) --- */
    .cta-section .trust-badges {
        margin-top: 40px;
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .cta-section .trust-badges span {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .cta-section .trust-badges .dot {
        font-size: 1.2rem;
        opacity: 0.3;
    }

    /* --- Responsive Adjustments --- */
    @media (max-width: 768px) {
        .cta-section { padding: 80px 20px; }
        .cta-section .cta-title { font-size: 2.5rem; }
        
        .left-side-hearts {
            width: 250px;
            left: -50px;
            opacity: 0.06; /* Fainter on mobile */
        }
        
        .cta-section .btn-cta { width: 100%; }
        
        .cta-section .trust-badges { 
            flex-direction: column; 
            gap: 10px; 
        }
        .cta-section .trust-badges .dot { 
            display: none; 
        }
    }
</style>

<section class="cta-section">
    <svg class="left-side-hearts" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
        <path d="M12 5 9.04 9.2a3.11 3.11 0 0 0 0 4.1l2.96 3.7 2.96-3.7a3.11 3.11 0 0 0 0-4.1L12 5Z"/>
    </svg>

    <div class="container">
        <div class="cta-content">
            
            <h2 class="cta-title">Ready to Find Your Perfect Match?</h2>
            
            <p class="cta-subtitle">
                Join thousands of successful couples who found their life partners through HappilyWeds. 
                Your journey to lifelong happiness starts right here.
            </p>
            
            <a href="{{ route('register') ?? '#' }}" class="btn-cta">
                <i class="bi bi-heart-fill"></i> Create Free Profile
            </a>
            
            <div class="trust-badges">
                <span><i class="bi bi-check2-circle"></i> Free Registration</span>
                <span class="dot">•</span>
                <span><i class="bi bi-shield-check"></i> 100% Verified Profiles</span>
                <span class="dot">•</span>
                <span><i class="bi bi-lock-fill"></i> Safe & Secure</span>
                <span class="dot">•</span>
                <span><i class="bi bi-chat-dots"></i> Free Unlimited Chat</span>
            </div>
            
        </div>
    </div>
</section>