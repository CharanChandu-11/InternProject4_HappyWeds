@extends('layouts.master')

@section('title', 'Wedding Planning | HappilyWeds')
@push('page-styles')
<style>
    .planning-section {
        padding: 150px 0;
        background-color: #f9f9f9;
    }
    .planning-section .section-title h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        font-weight: 700;
        color: #2d1b2e;
        margin-bottom: 15px;
    }

    .planning-section .section-title p {
        font-family: 'Poppins', sans-serif;
        font-size: 1.1rem;
        color: #6b5b6b;
        margin-bottom: 40px;
    }

    /* --- Feature Cards --- */
    .feature-card {
        background-color: #fff;
        border-radius: 12px;
        padding: 50px 30px 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }

    .feature-card .feature-icon {
        font-size: 2.5rem;
        color: #e75480;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
</style>
@endpush
@section('page-content')
<section class="planning-section">
    <div class="container">
        <div class="section-title">
            <h2>Wedding Planning Services</h2>
            <p>From venue selection to vendor coordination, we offer comprehensive wedding planning services to make your special day unforgettable.</p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-calendar-event"></i></div>
                    <h3>Event Coordination</h3>
                    <p>Our expert coordinators will manage every detail of your wedding day, ensuring a seamless and stress-free experience.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-people-fill"></i></div>
                    <h3>Vendor Management</h3>
                    <p>We connect you with trusted vendors for catering, photography, decor, and more, handling all communications and logistics.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-house-door-fill"></i></div>
                    <h3>Venue Selection</h3>
                    <p>Our team will help you find the perfect venue that matches your vision and accommodates your guest list.</p>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-gift-fill"></i></div>
                    <h3>Gift Registry</h3>
                    <p>Create a personalized gift registry for your guests, making it easy for them to choose the perfect present for you.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-music-note-beamed"></i></div>
                    <h3>Entertainment Booking</h3>
                    <p>We can arrange for live music, DJs, and other entertainment options to keep your guests dancing all night long.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="bi bi-brush-fill"></i></div>
                    <h3>Decor & Theme Design</h3>
                    <p>Our creative team will work with you to design a stunning decor and theme that reflects your unique style and love story.</p>
                </div>
            </div>
        </div>
        <div class="inquiry-section text-center mt-5">
            <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">Contact Us for a Consultation</a>
        </div>
    </div>
</section>
@endsection