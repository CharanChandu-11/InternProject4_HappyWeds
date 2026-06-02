@extends('layouts.auth')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap');

    /* --- Page & Canvas Setup --- */
    body, html {
        height: 100%;
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background-color: #0a0409; 
        overflow-x: hidden;
    }

    #soft-aurora-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 0; 
        pointer-events: none; 
    }

    #soft-aurora-container canvas {
        width: 100%;
        height: 100%;
        display: block;
    }

    /* --- Floating Neon Hearts Animation --- */
    .floating-hearts-container {
        position: fixed;
        inset: 0;
        z-index: 1;
        pointer-events: none;
        overflow: hidden;
    }

    .neon-heart {
        position: absolute;
        bottom: -100px;
        opacity: 0;
        animation: floatUp 12s linear infinite;
        filter: drop-shadow(0 0 8px #e75480) drop-shadow(0 0 15px #e75480);
    }

    .neon-heart svg {
        width: 100%;
        height: 100%;
        fill: none;
        stroke: #ff8eb3; /* Lighter pink for the core line */
        stroke-width: 2.5;
    }

    @keyframes floatUp {
        0% { transform: translateY(0) scale(0.5) rotate(-15deg); opacity: 0; }
        10% { opacity: 0.8; }
        90% { opacity: 0.8; }
        100% { transform: translateY(-120vh) scale(1.5) rotate(20deg); opacity: 0; }
    }

    /* Individual Heart Delays and Positions */
    .heart-1 { left: 15%; width: 40px; animation-delay: 0s; animation-duration: 15s; }
    .heart-2 { left: 80%; width: 60px; animation-delay: 3s; animation-duration: 12s; }
    .heart-3 { left: 35%; width: 30px; animation-delay: 6s; animation-duration: 14s; }
    .heart-4 { left: 70%; width: 50px; animation-delay: 8s; animation-duration: 16s; }
    .heart-5 { left: 25%; width: 45px; animation-delay: 11s; animation-duration: 13s; }
    .heart-6 { left: 60%; width: 35px; animation-delay: 14s; animation-duration: 15s; }

    /* --- Center the Form (Adjusted for Header) --- */
    .auth-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 100px 20px 40px; /* Top padding clears the fixed navbar */
        position: relative;
        z-index: 10;
    }

    /* --- Solid NEON Card --- */
    .neon-card {
        background: #0d0612; /* Solid dark background, NOT transparent */
        border: 2px solid #e75480;
        border-radius: 24px;
        /* Outer glow and inner glow to create the neon effect */
        box-shadow: 0 0 20px rgba(231, 84, 128, 0.4), 
                    inset 0 0 15px rgba(231, 84, 128, 0.2),
                    0 25px 50px rgba(0, 0, 0, 0.8);
        width: 100%;
        max-width: 450px;
        padding: 40px;
        color: #ffffff;
        position: relative;
    }

    .card-header-custom {
        text-align: center;
        margin-bottom: 30px;
    }

    .card-header-custom h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 8px;
        color: #ffffff;
        /* Neon text glow */
        text-shadow: 0 0 10px rgba(231, 84, 128, 0.8), 0 0 20px rgba(231, 84, 128, 0.4);
    }

    .card-header-custom p {
        font-size: 0.9rem;
        color: #fca9c5; /* Soft neon pink text */
        margin: 0;
    }

    /* --- Form Controls --- */
    .form-group {
        margin-bottom: 20px;
    }

    .form-label-custom {
        display: block;
        font-size: 0.85rem;
        font-weight: 500;
        margin-bottom: 8px;
        color: #e0d5df;
        letter-spacing: 0.5px;
    }

    .form-control-custom {
        width: 100%;
        background: #170b1e; /* Solid dark input */
        border: 1px solid rgba(231, 84, 128, 0.4);
        color: #ffffff;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 0.95rem;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
    }

    .form-control-custom:focus {
        outline: none;
        background: #1c0e24;
        border-color: #ff7eb3;
        /* Neon glow on focus */
        box-shadow: 0 0 12px rgba(231, 84, 128, 0.6), inset 0 0 5px rgba(231, 84, 128, 0.3);
    }

    .form-control-custom::placeholder {
        color: rgba(255, 255, 255, 0.3);
    }

    .is-invalid {
        border-color: #ff3366 !important;
        box-shadow: 0 0 10px rgba(255, 51, 102, 0.4);
    }

    .invalid-feedback {
        display: block;
        color: #ff8da1;
        font-size: 0.8rem;
        margin-top: 6px;
    }

    /* --- Checkbox & Links (Login Specific) --- */
    .flex-between {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .form-check-custom {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-check-input-custom {
        appearance: none;
        background-color: #170b1e;
        border: 1px solid rgba(231, 84, 128, 0.4);
        width: 16px;
        height: 16px;
        border-radius: 4px;
        cursor: pointer;
        position: relative;
        transition: all 0.2s ease;
    }

    .form-check-input-custom:checked {
        background-color: #e75480;
        border-color: #ff7eb3;
        box-shadow: 0 0 8px rgba(231, 84, 128, 0.6);
    }

    .form-check-input-custom:checked::after {
        content: '✔';
        position: absolute;
        color: white;
        font-size: 10px;
        top: -1px;
        left: 2px;
    }

    .forgot-link {
        font-size: 0.85rem;
        color: #ff7eb3;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .forgot-link:hover {
        color: #ffffff;
        text-shadow: 0 0 8px #ffffff, 0 0 15px #ff7eb3;
    }

    /* --- Submit Button --- */
    .btn-submit {
        width: 100%;
        background: linear-gradient(135deg, #e75480 0%, #ff1493 100%);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 14px;
        font-size: 1rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 0 15px rgba(231, 84, 128, 0.6);
        text-transform: uppercase;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 25px rgba(255, 20, 147, 0.8);
        background: linear-gradient(135deg, #ff1493 0%, #e75480 100%);
    }

    /* --- Register Link --- */
    .login-link {
        text-align: center;
        margin-top: 25px;
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .login-link a {
        color: #ff7eb3;
        text-decoration: none;
        font-weight: 600;
        text-shadow: 0 0 5px rgba(255, 126, 179, 0.5);
        transition: all 0.3s;
    }

    .login-link a:hover {
        color: #ffffff;
        text-shadow: 0 0 8px #ffffff, 0 0 15px #ff7eb3;
    }

    /* --- REGULAR HEADER CSS --- */
    .main-navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1030;
        padding: 15px 0;
        transition: all 0.3s ease; 
        background-color: transparent;
        box-shadow: none;
    }
    .main-navbar.scrolled {
        background-color: #ffffff;
        box-shadow: 0 4px 20px rgba(231, 84, 128, 0.08);
        padding: 10px 0; 
    }
    .logo-wrapper { display: flex; flex-direction: column; line-height: 1.1; }
    .logo-text { font-family: 'Playfair Display', serif; font-size: 2.2rem; font-weight: 800; color: #e75480; }
    .logo-tagline { font-family: 'Poppins', sans-serif; font-size: 0.75rem; font-weight: 400; letter-spacing: 2px; text-transform: uppercase; color: #f06292; }
    .main-navbar .nav-link { font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 0.95rem; color: #4a2333 !important; margin: 0 5px; padding: 8px 12px; position: relative; transition: color 0.3s ease; }
    .main-navbar.inner-page-nav .nav-link { color: #e75480 !important; text-shadow: 0 0 2px rgba(0,0,0,0.8); }
    .main-navbar.scrolled.inner-page-nav .nav-link { text-shadow: none; }
    .main-navbar .nav-link:hover { color: #ff7eb3 !important; }
    .main-navbar .nav-link::after { content: ''; position: absolute; width: 0; height: 2px; bottom: 0; left: 50%; transform: translateX(-50%); background-color: #e75480; transition: width 0.3s ease; }
    .main-navbar .nav-link:hover::after, .main-navbar .nav-link.active::after { width: 70%; }
    .main-navbar .btn-primary { background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%); color: #ffffff; border: none; border-radius: 30px; padding: 10px 24px; font-weight: 600; }
    .main-navbar .nav-login { font-weight: 600; border: 2px solid #e75480; border-radius: 30px; padding: 8px 20px !important; color: #e75480 !important; background: rgba(0,0,0,0.5); backdrop-filter: blur(5px); }
    .main-navbar.scrolled .nav-login { background: transparent; }
    @media (max-width: 991px) {
        .navbar-collapse { background: #ffffff; padding: 20px; border-radius: 12px; box-shadow: 0 10px 30px rgba(231, 84, 128, 0.1); margin-top: 15px; }
        .main-navbar.inner-page-nav .nav-link { text-shadow: none; }
    }
</style>

<nav class="navbar navbar-expand-lg main-navbar inner-page-nav">
    <div class="container">
        <a class="navbar-brand text-decoration-none" href="/">
            <div class="logo-wrapper">
                <span class="logo-text">HappilyWeds</span>
                <span class="logo-tagline">Matrimony & Matchmaking</span>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" style="background: rgba(255,255,255,0.8);">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/search">Search Profiles</a></li>
                <li class="nav-item"><a class="nav-link" href="/success-stories">Success Stories</a></li>
                
                @auth
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> My Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                            <li><a class="dropdown-item" href="/profile/edit">My Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item ms-lg-3 mb-2 mb-lg-0 mt-3 mt-lg-0">
                        <a class="nav-link nav-login text-center" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-primary w-100" href="{{ route('register') }}">Register Free</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div id="soft-aurora-container"></div>

<div class="floating-hearts-container">
    @for ($i = 1; $i <= 6; $i++)
    <div class="neon-heart heart-{{ $i }}">
        <svg viewBox="0 0 24 24">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
        </svg>
    </div>
    @endfor
</div>

<div class="auth-wrapper">
    <div class="neon-card">
        <div class="card-header-custom">
            <h2>Welcome Back</h2>
            <p>Sign in to continue your journey</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label-custom">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label-custom">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control-custom @error('password') is-invalid @enderror" name="password" placeholder="••••••••" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="flex-between">
                <div class="form-check-custom">
                    <input class="form-check-input-custom" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-label-custom mb-0" for="remember" style="cursor: pointer;">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                @endif
            </div>

            <button type="submit" class="btn-submit">
                {{ __('Sign In') }}
            </button>

            <div class="login-link">
                Don't have an account? <a href="{{ route('register') }}">Register Free</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Navbar Scroll Logic
    const navbar = document.querySelector('.main-navbar');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // WebGL Logic
    const container = document.getElementById('soft-aurora-container');
    const canvas = document.createElement('canvas');
    container.appendChild(canvas);
    
    const gl = canvas.getContext('webgl2') || canvas.getContext('webgl');
    if (!gl) {
        container.style.background = "linear-gradient(to bottom, #1a0f1c, #e75480)";
        return;
    }

    const config = {
        speed: 0.6,
        scale: 1.5,
        brightness: 1.0,
        color1: [247/255, 247/255, 247/255], 
        color2: [225/255, 0/255, 255/255],   
        noiseFreq: 2.5,
        noiseAmp: 1.0,
        bandHeight: 0.5,
        bandSpread: 1.0,
        octaveDecay: 0.1,
        layerOffset: 0.0,
        colorSpeed: 1.0,
        enableMouseInteraction: true,
        mouseInfluence: 0.25
    };

    const vertexShaderSrc = `
        attribute vec2 position;
        void main() { gl_Position = vec4(position, 0.0, 1.0); }
    `;

    const fragmentShaderSrc = `
        precision highp float;
        uniform float uTime;
        uniform vec3 uResolution;
        uniform float uSpeed, uScale, uBrightness;
        uniform vec3 uColor1, uColor2;
        uniform float uNoiseFreq, uNoiseAmp, uBandHeight, uBandSpread, uOctaveDecay, uLayerOffset, uColorSpeed;
        uniform vec2 uMouse;
        uniform float uMouseInfluence;
        uniform bool uEnableMouse;

        #define TAU 6.28318

        vec3 gradientHash(vec3 p) {
            p = vec3(dot(p, vec3(127.1, 311.7, 234.6)), dot(p, vec3(269.5, 183.3, 198.3)), dot(p, vec3(169.5, 283.3, 156.9)));
            vec3 h = fract(sin(p) * 43758.5453123);
            float phi = acos(2.0 * h.x - 1.0);
            float theta = TAU * h.y;
            return vec3(cos(theta) * sin(phi), sin(theta) * cos(phi), cos(phi));
        }

        float quinticSmooth(float t) {
            float t2 = t * t; float t3 = t * t2;
            return 6.0 * t3 * t2 - 15.0 * t2 * t2 + 10.0 * t3;
        }

        vec3 cosineGradient(float t, vec3 a, vec3 b, vec3 c, vec3 d) {
            return a + b * cos(TAU * (c * t + d));
        }

        float perlin3D(float amplitude, float frequency, float px, float py, float pz) {
            float x = px * frequency; float y = py * frequency;
            float fx = floor(x); float fy = floor(y); float fz = floor(pz);
            float cx = ceil(x);  float cy = ceil(y);  float cz = ceil(pz);
            vec3 g000 = gradientHash(vec3(fx, fy, fz)); vec3 g100 = gradientHash(vec3(cx, fy, fz));
            vec3 g010 = gradientHash(vec3(fx, cy, fz)); vec3 g110 = gradientHash(vec3(cx, cy, fz));
            vec3 g001 = gradientHash(vec3(fx, fy, cz)); vec3 g101 = gradientHash(vec3(cx, fy, cz));
            vec3 g011 = gradientHash(vec3(fx, cy, cz)); vec3 g111 = gradientHash(vec3(cx, cy, cz));
            float d000 = dot(g000, vec3(x - fx, y - fy, pz - fz)); float d100 = dot(g100, vec3(x - cx, y - fy, pz - fz));
            float d010 = dot(g010, vec3(x - fx, y - cy, pz - fz)); float d110 = dot(g110, vec3(x - cx, y - cy, pz - fz));
            float d001 = dot(g001, vec3(x - fx, y - fy, pz - cz)); float d101 = dot(g101, vec3(x - cx, y - fy, pz - cz));
            float d011 = dot(g011, vec3(x - fx, y - cy, pz - cz)); float d111 = dot(g111, vec3(x - cx, y - cy, pz - cz));
            float sx = quinticSmooth(x - fx); float sy = quinticSmooth(y - fy); float sz = quinticSmooth(pz - fz);
            float lx00 = mix(d000, d100, sx); float lx10 = mix(d010, d110, sx);
            float lx01 = mix(d001, d101, sx); float lx11 = mix(d011, d111, sx);
            float ly0 = mix(lx00, lx10, sy); float ly1 = mix(lx01, lx11, sy);
            return amplitude * mix(ly0, ly1, sz);
        }

        float auroraGlow(float t, vec2 shift) {
            vec2 uv = gl_FragCoord.xy / uResolution.y;
            uv += shift;
            float noiseVal = 0.0; float freq = uNoiseFreq; float amp = uNoiseAmp; vec2 samplePos = uv * uScale;
            for (float i = 0.0; i < 3.0; i += 1.0) {
                noiseVal += perlin3D(amp, freq, samplePos.x, samplePos.y, t);
                amp *= uOctaveDecay; freq *= 2.0;
            }
            float yBand = uv.y * 10.0 - uBandHeight * 10.0;
            return 0.3 * max(exp(uBandSpread * (1.0 - 1.1 * abs(noiseVal + yBand))), 0.0);
        }

        void main() {
            vec2 uv = gl_FragCoord.xy / uResolution.xy;
            float t = uSpeed * 0.4 * uTime;
            vec2 shift = vec2(0.0);
            if (uEnableMouse) { shift = (uMouse - 0.5) * uMouseInfluence; }
            vec3 col = vec3(0.0);
            col += vec3(0.05, 0.02, 0.05); // Base background color
            col += 0.99 * auroraGlow(t, shift) * cosineGradient(uv.x + uTime * uSpeed * 0.2 * uColorSpeed, vec3(0.5), vec3(0.5), vec3(1.0), vec3(0.3, 0.20, 0.20)) * uColor1;
            col += 0.99 * auroraGlow(t + uLayerOffset, shift) * cosineGradient(uv.x + uTime * uSpeed * 0.1 * uColorSpeed, vec3(0.5), vec3(0.5), vec3(2.0, 1.0, 0.0), vec3(0.5, 0.20, 0.25)) * uColor2;
            col *= uBrightness;
            gl_FragColor = vec4(col, 1.0);
        }
    `;

    function compileShader(type, source) {
        const shader = gl.createShader(type);
        gl.shaderSource(shader, source);
        gl.compileShader(shader);
        if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
            console.error(gl.getShaderInfoLog(shader));
            gl.deleteShader(shader); return null;
        }
        return shader;
    }

    const vs = compileShader(gl.VERTEX_SHADER, vertexShaderSrc);
    const fs = compileShader(gl.FRAGMENT_SHADER, fragmentShaderSrc);
    const program = gl.createProgram();
    gl.attachShader(program, vs);
    gl.attachShader(program, fs);
    gl.linkProgram(program);
    gl.useProgram(program);

    const vertices = new Float32Array([-1.0, -1.0, 3.0, -1.0, -1.0, 3.0]);
    const buffer = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, buffer);
    gl.bufferData(gl.ARRAY_BUFFER, vertices, gl.STATIC_DRAW);

    const posAttrib = gl.getAttribLocation(program, "position");
    gl.enableVertexAttribArray(posAttrib);
    gl.vertexAttribPointer(posAttrib, 2, gl.FLOAT, false, 0, 0);

    const uniforms = {
        uTime: gl.getUniformLocation(program, "uTime"), uResolution: gl.getUniformLocation(program, "uResolution"),
        uSpeed: gl.getUniformLocation(program, "uSpeed"), uScale: gl.getUniformLocation(program, "uScale"),
        uBrightness: gl.getUniformLocation(program, "uBrightness"), uColor1: gl.getUniformLocation(program, "uColor1"),
        uColor2: gl.getUniformLocation(program, "uColor2"), uNoiseFreq: gl.getUniformLocation(program, "uNoiseFreq"),
        uNoiseAmp: gl.getUniformLocation(program, "uNoiseAmp"), uBandHeight: gl.getUniformLocation(program, "uBandHeight"),
        uBandSpread: gl.getUniformLocation(program, "uBandSpread"), uOctaveDecay: gl.getUniformLocation(program, "uOctaveDecay"),
        uLayerOffset: gl.getUniformLocation(program, "uLayerOffset"), uColorSpeed: gl.getUniformLocation(program, "uColorSpeed"),
        uMouse: gl.getUniformLocation(program, "uMouse"), uMouseInfluence: gl.getUniformLocation(program, "uMouseInfluence"),
        uEnableMouse: gl.getUniformLocation(program, "uEnableMouse")
    };

    gl.uniform1f(uniforms.uSpeed, config.speed); gl.uniform1f(uniforms.uScale, config.scale);
    gl.uniform1f(uniforms.uBrightness, config.brightness); gl.uniform3f(uniforms.uColor1, ...config.color1);
    gl.uniform3f(uniforms.uColor2, ...config.color2); gl.uniform1f(uniforms.uNoiseFreq, config.noiseFreq);
    gl.uniform1f(uniforms.uNoiseAmp, config.noiseAmp); gl.uniform1f(uniforms.uBandHeight, config.bandHeight);
    gl.uniform1f(uniforms.uBandSpread, config.bandSpread); gl.uniform1f(uniforms.uOctaveDecay, config.octaveDecay);
    gl.uniform1f(uniforms.uLayerOffset, config.layerOffset); gl.uniform1f(uniforms.uColorSpeed, config.colorSpeed);
    gl.uniform1f(uniforms.uMouseInfluence, config.mouseInfluence); gl.uniform1i(uniforms.uEnableMouse, config.enableMouseInteraction ? 1 : 0);

    let currentMouse = [0.5, 0.5]; let targetMouse = [0.5, 0.5];
    if (config.enableMouseInteraction) {
        document.addEventListener('mousemove', (e) => { targetMouse = [e.clientX / window.innerWidth, 1.0 - (e.clientY / window.innerHeight)]; });
        document.addEventListener('mouseleave', () => { targetMouse = [0.5, 0.5]; });
    }

    function resize() {
        canvas.width = window.innerWidth; canvas.height = window.innerHeight;
        gl.viewport(0, 0, canvas.width, canvas.height);
        gl.uniform3f(uniforms.uResolution, canvas.width, canvas.height, canvas.width / canvas.height);
    }
    window.addEventListener('resize', resize);
    resize();

    function render(time) {
        gl.uniform1f(uniforms.uTime, time * 0.001);
        if (config.enableMouseInteraction) {
            currentMouse[0] += 0.05 * (targetMouse[0] - currentMouse[0]); currentMouse[1] += 0.05 * (targetMouse[1] - currentMouse[1]);
            gl.uniform2f(uniforms.uMouse, currentMouse[0], currentMouse[1]);
        } else {
            gl.uniform2f(uniforms.uMouse, 0.5, 0.5);
        }
        gl.drawArrays(gl.TRIANGLES, 0, 3);
        requestAnimationFrame(render);
    }
    requestAnimationFrame(render);
});
</script>
@endsection