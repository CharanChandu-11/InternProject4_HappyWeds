@extends('layouts.master')

@section('title', 'Success Stories - HappilyWeds Matrimony')

@push('page-styles')
<style>
    :root {
        --primary-pink: #f8a5c2;
        --light-pink: #fdeff6;
        --dark-pink: #e75480;
        --gold: #d4af37;
        --text-dark: #2d3748;
        --text-light: #718096;
        --gradient-pink: linear-gradient(135deg, #f8a5c2, #e75480);
    }

    body {
        font-family: 'Poppins', sans-serif;
        color: var(--text-dark);
        background-color: #fffafb;
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: 'Playfair Display', serif;
    }

    /* --- Custom Heart SVG Pattern Background --- */
    .bg-pattern-hearts {
        background-color: #fffafb;
        background-image: url("data:image/svg+xml,%3Csvg width='52' height='52' viewBox='0 0 52 52' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23f8a5c2' fill-opacity='0.15'%3E%3Cpath d='M26 38.18l-1.32-1.2C19.95 32.66 16 29.07 16 24.6c0-3.63 2.87-6.5 6.5-6.5 2.06 0 4.03 1.04 5.5 2.68 1.47-1.64 3.44-2.68 5.5-2.68 3.63 0 6.5 2.87 6.5 6.5 0 4.47-3.95 8.06-8.68 12.38L26 38.18z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    /* --- Hero Section --- */
    .success-hero {
        background: linear-gradient(rgba(15, 5, 24, 0.7), rgba(45, 11, 36, 0.7)), 
                    url('https://images.unsplash.com/photo-1511285560929-80b456fea0bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover;
        padding: 160px 0 100px;
    }

    /* --- Share Your Story Section (Romantic Red/Pink Overlay) --- */
    .share-story-section {
        background: linear-gradient(135deg, rgba(74, 15, 36, 0.9), rgba(231, 84, 128, 0.85)), 
                    url('https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&w=1920&q=80') center/cover;
        background-attachment: fixed; /* Creates a beautiful parallax effect */
    }

    /* --- Typography & Utilities --- */
    .text-pink { color: var(--dark-pink) !important; }
    .bg-pink-light { background-color: var(--light-pink) !important; }
    .bg-gradient-pink { background: var(--gradient-pink) !important; color: white; }
    
    .section-title::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: var(--gradient-pink);
        margin: 15px auto 0;
        border-radius: 3px;
    }

    /* --- Hover Effects --- */
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(231, 84, 128, 0.15) !important;
    }

    /* --- Featured Story --- */
    .featured-quote-mark {
        position: absolute;
        top: 10px;
        left: 20px;
        font-size: 8rem;
        color: var(--light-pink);
        font-family: Georgia, serif;
        line-height: 1;
        z-index: 0;
    }

    /* --- Filters --- */
    .filter-btn {
        background: var(--white);
        border: 1px solid #e2e8f0;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 500;
        color: var(--text-light);
        transition: all 0.3s ease;
    }
    .filter-btn:hover, .filter-btn.active {
        background: var(--gradient-pink);
        border-color: transparent;
        color: white;
        box-shadow: 0 4px 10px rgba(231, 84, 128, 0.3);
    }

    /* --- Cards --- */
    .couple-avatar {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border: 3px solid var(--light-pink);
    }
    .story-image {
        height: 240px;
        object-fit: cover;
    }
    .video-thumbnail {
        height: 220px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .video-container:hover .video-thumbnail {
        transform: scale(1.05);
    }
    .play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--dark-pink);
        font-size: 1.8rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .video-story-card:hover .play-button {
        background: var(--dark-pink);
        color: white;
        transform: translate(-50%, -50%) scale(1.1);
    }

    /* --- Custom Modals --- */
    .custom-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 5, 24, 0.85);
        backdrop-filter: blur(5px);
        z-index: 1050;
        align-items: center;
        justify-content: center;
        padding: 20px;
        animation: fadeIn 0.3s ease;
    }
    .custom-modal-content {
        background: white;
        border-radius: 20px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        box-shadow: 0 25px 50px rgba(0,0,0,0.3);
    }
    .btn-close-modal {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--light-pink);
        color: var(--dark-pink);
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        z-index: 10;
        transition: all 0.3s ease;
    }
    .btn-close-modal:hover {
        background: var(--dark-pink);
        color: white;
        transform: rotate(90deg);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('page-content')

<section class="success-hero text-white text-center">
    <div class="container position-relative z-2">
        <h1 class="display-3 fw-bold mb-3 text-shadow">Real Love Stories</h1>
        <p class="lead mx-auto" style="max-width: 700px; opacity: 0.9;">
            Discover inspiring stories of couples who found their perfect match through HappilyWeds. 
            These real-life stories prove that true love knows no boundaries.
        </p>
    </div>
</section>

<section class="py-5 bg-pattern-hearts border-bottom">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col">
                <div class="p-4 rounded-4 bg-white shadow-sm hover-lift h-100">
                    <div class="display-5 fw-bold text-pink stat-number mb-2" data-count="500+">0</div>
                    <div class="fw-semibold text-dark">Happy Marriages</div>
                </div>
            </div>
            <div class="col">
                <div class="p-4 rounded-4 bg-white shadow-sm hover-lift h-100">
                    <div class="display-5 fw-bold text-pink stat-number mb-2" data-count="500+">0</div>
                    <div class="fw-semibold text-dark">Verified Members</div>
                </div>
            </div>
            <div class="col">
                <div class="p-4 rounded-4 bg-white shadow-sm hover-lift h-100">
                    <div class="display-5 fw-bold text-pink stat-number mb-2" data-count="200+">0</div>
                    <div class="fw-semibold text-dark">Cities Covered</div>
                </div>
            </div>
            <div class="col">
                <div class="p-4 rounded-4 bg-white shadow-sm hover-lift h-100">
                    <div class="display-5 fw-bold text-pink stat-number mb-2" data-count="5+">0</div>
                    <div class="fw-semibold text-dark">Countries Covered</div>
                </div>
            </div>
            <div class="col">
                <div class="p-4 rounded-4 bg-white shadow-sm hover-lift h-100">
                    <div class="display-5 fw-bold text-pink stat-number mb-2" data-count="98%">0</div>
                    <div class="fw-semibold text-dark">Success Rate</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 my-4 bg-pattern-hearts">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title fw-bold">Featured Love Story</h2>
            <p class="text-muted mt-2">An inspiring journey of love that began with a simple connection</p>
        </div>
        
        <div class="card border-0 shadow-lg rounded-5 overflow-hidden">
            <div class="row g-0">
                <div class="col-lg-7 p-4 p-md-5 position-relative d-flex flex-column justify-content-center bg-white">
                    <span class="featured-quote-mark">"</span>
                    <p class="fs-4 fst-italic text-dark mb-4 position-relative z-1" style="line-height: 1.7;">
                        "We were both skeptical about online matrimony, but HappilyWeds changed our lives. 
                        From our first chat, we knew there was something special. Despite being from different 
                        cities, the connection was instant. Today, we're happily married and expecting our first child!"
                    </p>
                    
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&q=80" 
                             alt="Featured Couple" class="rounded-circle border border-3 border-pink shadow-sm" style="width:80px; height:80px; object-fit:cover;">
                        <div>
                            <h4 class="fw-bold mb-1">Raj & Priya</h4>
                            <p class="text-muted mb-1 small">Software Engineer & Doctor</p>
                            <span class="badge bg-pink-light text-pink rounded-pill py-2 px-3">
                                <i class="bi bi-calendar-heart me-1"></i> Married Mar 15, 2023
                            </span>
                        </div>
                    </div>
                    
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        <span class="badge bg-light text-dark border py-2 px-3 fw-normal"><i class="bi bi-chat-dots text-pink me-2"></i>3 months chatting</span>
                        <span class="badge bg-light text-dark border py-2 px-3 fw-normal"><i class="bi bi-geo-alt text-pink me-2"></i>Different cities</span>
                        <span class="badge bg-light text-dark border py-2 px-3 fw-normal"><i class="bi bi-heart text-pink me-2"></i>98% match score</span>
                    </div>
                </div>
                <div class="col-lg-5" style="background: url('https://images.unsplash.com/photo-1519741497674-611481863552?w=800&q=80') center/cover; min-height: 400px;">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-pattern-hearts">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title fw-bold">Love Stories That Inspire</h2>
            <p class="text-muted mt-2">Browse through our collection of real success stories</p>
        </div>
        
        <div class="d-flex justify-content-center flex-wrap gap-2 mb-5">
            <button class="filter-btn active" data-filter="all">All Stories</button>
            <button class="filter-btn" data-filter="recent">Recent</button>
            <button class="filter-btn" data-filter="long-distance">Long Distance</button>
            <button class="filter-btn" data-filter="inter-caste">Inter-Caste</button>
            <button class="filter-btn" data-filter="second-marriage">Second Marriage</button>
            <button class="filter-btn" data-filter="love-marriage">Love Marriage</button>
        </div>
        
        <div class="row g-4" id="stories-grid">
            @if(isset($stories))
                @foreach($stories as $index => $story)
                <div class="col-lg-4 col-md-6 story-item" data-category="{{ $story['category'] }}">
                    <div class="card h-100 border-0 shadow-sm rounded-4 hover-lift" style="cursor: pointer;" onclick="openStoryModal({{ $index }})">
                        <img src="{{ $story['image'] }}" alt="{{ $story['couple'] }}" class="card-img-top story-image rounded-top-4">
                        <div class="card-body p-4 d-flex flex-column bg-white rounded-bottom-4">
                            <p class="card-text fst-italic text-muted mb-4 flex-grow-1 line-clamp-3">"{{ Str::limit($story['quote'], 130) }}"</p>
                            
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <img src="{{ $story['avatar'] }}" alt="{{ $story['couple'] }}" class="couple-avatar rounded-circle shadow-sm">
                                <div>
                                    <h5 class="fw-bold mb-0 fs-6">{{ $story['couple'] }}</h5>
                                    <small class="text-muted d-block">{{ $story['profession'] }}</small>
                                    <small class="text-pink"><i class="bi bi-geo-alt-fill"></i> {{ $story['location'] }}</small>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>{{ $story['date'] }}</small>
                                <span class="text-pink fw-semibold small">Read Story <i class="bi bi-arrow-right"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        
        <div class="text-center mt-5">
            <button class="btn btn-lg bg-gradient-pink rounded-pill px-5 shadow-sm hover-lift" id="loadMoreBtn">
                <i class="bi bi-plus-circle me-2"></i> Load More
            </button>
        </div>
    </div>
</section>

<section class="py-5 bg-pattern-hearts">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="section-title fw-bold">Watch Their Love Stories</h2>
            <p class="text-muted mt-2">Experience the joy through heartfelt video testimonials</p>
        </div>
        
        <div class="row g-4">
            @if(isset($videoStories))
                @foreach($videoStories as $video)
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden hover-lift video-story-card" style="cursor: pointer;" onclick="playVideo('{{ $video['id'] }}')">
                        <div class="video-container position-relative overflow-hidden">
                            <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}" class="w-100 video-thumbnail">
                            <div class="play-button">
                                <i class="bi bi-play-fill ms-1"></i>
                            </div>
                        </div>
                        <div class="card-body p-4 bg-white">
                            <h5 class="fw-bold mb-2">{{ $video['title'] }}</h5>
                            <div class="text-pink small fw-semibold mb-2">
                                <i class="bi bi-heart-fill me-1"></i> {{ $video['couple'] }}
                            </div>
                            <p class="text-muted small mb-0">{{ Str::limit($video['description'], 90) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<section class="py-5 text-white text-center position-relative share-story-section">
    <div class="container py-5">
        <h2 class="display-5 fw-bold mb-3 text-shadow">Share Your Success Story</h2>
        <p class="lead mb-5 mx-auto" style="max-width: 600px; opacity: 0.9;">
            Found your perfect match through HappilyWeds? Share your love story with us and inspire others to find their happily ever after.
        </p>
        <button class="btn btn-light btn-lg rounded-pill px-5 text-dark fw-bold hover-lift shadow" onclick="openShareForm()">
            <i class="bi bi-pencil-square text-pink me-2"></i> Share Your Story
        </button>
    </div>
</section>

<div class="custom-modal" id="storyModal">
    <div class="custom-modal-content" style="max-width: 700px;">
        <button class="btn-close-modal" onclick="closeStoryModal()"><i class="bi bi-x-lg"></i></button>
        <div id="storyModalContent">
            </div>
    </div>
</div>

<div class="custom-modal" id="videoModal">
    <div class="custom-modal-content bg-transparent shadow-none" style="max-width: 900px;">
        <button class="btn-close-modal text-white bg-dark border-light" onclick="closeVideoModal()"><i class="bi bi-x-lg"></i></button>
        <div id="videoModalContent" class="p-0 rounded-4 overflow-hidden shadow-lg bg-dark">
            </div>
    </div>
</div>

<div class="custom-modal" id="shareFormModal">
    <div class="custom-modal-content" style="max-width: 600px;">
        <button class="btn-close-modal" onclick="closeShareForm()"><i class="bi bi-x-lg"></i></button>
        <div class="p-4 p-md-5">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-pink mb-2">Share Your Journey</h3>
                <p class="text-muted small">We can't wait to hear how you met!</p>
            </div>
            
            <form id="shareStoryForm">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Bride's Name *</label>
                        <input type="text" class="form-control bg-light border-0" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Groom's Name *</label>
                        <input type="text" class="form-control bg-light border-0" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-semibold">Email Address *</label>
                        <input type="email" class="form-control bg-light border-0" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-semibold">Wedding Date *</label>
                        <input type="date" class="form-control bg-light border-0" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-semibold">Your Love Story *</label>
                        <textarea class="form-control bg-light border-0" rows="4" placeholder="How did you meet? What made it special?" required></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-semibold">Upload Photo</label>
                        <input type="file" class="form-control bg-light border-0" accept="image/*">
                    </div>
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn bg-gradient-pink rounded-pill px-5 py-2 w-100 hover-lift text-white fw-bold border-0">
                            <i class="bi bi-send me-2"></i> Submit Story
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Safe JSON parse for Blade
    const storiesData = {!! json_encode($stories ?? []) !!};

    document.addEventListener('DOMContentLoaded', function() {
        initCounters();
        initStoryFilters();
        initLoadMore();
    });
    
    // Statistics Counter Animation
    function initCounters() {
        const statNumbers = document.querySelectorAll('.stat-number[data-count]');
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const stat = entry.target;
                    const rawValue = stat.getAttribute('data-count');
                    let number = parseFloat(rawValue.replace(/[^0-9.]/g, ''));
                    let suffix = rawValue.replace(/[0-9.]/g, '');
                    
                    if (rawValue.includes('K')) number *= 1000;
                    if (rawValue.includes('M')) number *= 1000000;
                    
                    let current = 0;
                    const step = number / 50; // 50 frames
                    
                    const update = setInterval(() => {
                        current += step;
                        if (current >= number) {
                            stat.textContent = format(number) + suffix;
                            clearInterval(update);
                        } else {
                            stat.textContent = format(Math.floor(current)) + suffix;
                        }
                    }, 30);
                    observer.unobserve(stat);
                }
            });
        }, { threshold: 0.5 });
        
        statNumbers.forEach(stat => observer.observe(stat));
        
        function format(num) {
            if (num >= 1000000) return (num / 1000000).toFixed(1) + "M";
            if (num >= 1000) return (num / 1000).toFixed(0) + "K";
            return num;
        }
    }
    
    // Story Filtering
    function initStoryFilters() {
        const btns = document.querySelectorAll('.filter-btn');
        const cards = document.querySelectorAll('.story-item');
        
        btns.forEach(btn => {
            btn.addEventListener('click', function() {
                btns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const filter = this.dataset.filter;
                cards.forEach(card => {
                    card.style.display = (filter === 'all' || card.dataset.category === filter) ? 'block' : 'none';
                });
            });
        });
    }
    
    // Load More
    function initLoadMore() {
        const btn = document.getElementById('loadMoreBtn');
        if (!btn) return;
        
        btn.addEventListener('click', function() {
            const ogHtml = this.innerHTML;
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Loading...';
            this.disabled = true;
            
            setTimeout(() => {
                this.innerHTML = '<i class="bi bi-check2-all me-2"></i> All Caught Up!';
                // In reality, you'd append HTML here.
                setTimeout(() => this.style.display = 'none', 2000);
            }, 1000);
        });
    }
    
    // Modals Logic
    function playVideo(id) {
        const modal = document.getElementById('videoModal');
        const content = document.getElementById('videoModalContent');
        // Simple placeholder iframe
        content.innerHTML = `
            <div class="ratio ratio-16x9 bg-dark">
                <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1" allow="autoplay; fullscreen" class="rounded-4"></iframe>
            </div>
            <div class="p-4 text-white">
                <h4 class="fw-bold mb-1">A Magical Journey</h4>
                <p class="text-white-50 mb-0">Experience the beautiful moments of their special day.</p>
            </div>
        `;
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    function closeVideoModal() {
        document.getElementById('videoModal').style.display = 'none';
        document.body.style.overflow = 'auto';
        document.getElementById('videoModalContent').innerHTML = ''; // Stops audio
    }
    
    function openStoryModal(index) {
        const story = storiesData[index];
        if (!story) return;
        
        const content = document.getElementById('storyModalContent');
        content.innerHTML = `
            <div class="p-0">
                <div style="height: 250px; background: url('${story.image}') center/cover;" class="rounded-top-4"></div>
                <div class="p-4 p-md-5 bg-white rounded-bottom-4">
                    <div class="d-flex align-items-center gap-3 mb-4 mt-n5">
                        <img src="${story.avatar}" class="rounded-circle border border-4 border-white shadow" style="width:100px; height:100px; object-fit:cover; margin-top:-50px;">
                        <div>
                            <h3 class="fw-bold mb-0">${story.couple}</h3>
                            <p class="text-muted mb-0">${story.profession}</p>
                        </div>
                    </div>
                    
                    <p class="fs-5 fst-italic text-dark mb-4">"${story.quote}"</p>
                    
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge bg-light text-dark border py-2 px-3 fw-normal"><i class="bi bi-geo-alt text-pink me-1"></i> ${story.location}</span>
                        <span class="badge bg-light text-dark border py-2 px-3 fw-normal"><i class="bi bi-calendar-heart text-pink me-1"></i> Married ${story.date}</span>
                    </div>
                    
                    <h5 class="fw-bold border-bottom pb-2 mb-3">Their Journey</h5>
                    <p class="text-muted" style="line-height: 1.8;">${story.full_story || 'Their beautiful journey from first connection to marriage is an inspiration.'}</p>
                </div>
            </div>
        `;
        document.getElementById('storyModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    function closeStoryModal() {
        document.getElementById('storyModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    
    function openShareForm() {
        document.getElementById('shareFormModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    function closeShareForm() {
        document.getElementById('shareFormModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Form Submit
    document.getElementById('shareStoryForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = this.querySelector('button[type="submit"]');
        const ogText = btn.innerHTML;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Submitting...';
        btn.disabled = true;
        
        setTimeout(() => {
            alert('Thank you for sharing your love story!');
            this.reset();
            closeShareForm();
            btn.innerHTML = ogText;
            btn.disabled = false;
        }, 1500);
    });

    // Close Modals on click outside or Esc
    window.onclick = e => {
        if (e.target.classList.contains('custom-modal')) {
            e.target.style.display = 'none';
            document.body.style.overflow = 'auto';
            if (e.target.id === 'videoModal') document.getElementById('videoModalContent').innerHTML = '';
        }
    };
    
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            document.querySelectorAll('.custom-modal').forEach(m => m.style.display = 'none');
            document.body.style.overflow = 'auto';
            document.getElementById('videoModalContent').innerHTML = '';
        }
    });
</script>
@endpush