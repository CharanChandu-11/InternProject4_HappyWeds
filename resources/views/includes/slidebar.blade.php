<style>
    /* --- PREMIUM UNIQUE SIDEBAR STYLING --- */
    :root {
        --sb-bg: #0b0c10;          /* Deep rich black */
        --sb-text: #9ca3af;        /* Soft gray text */
        --sb-text-hover: #ffffff;  /* Pure white */
        --sb-accent-1: #ff6b6b;    /* Vibrant Coral */
        --sb-accent-2: #e75480;    /* Matrimony Pink */
        --sb-gradient: linear-gradient(135deg, var(--sb-accent-1) 0%, var(--sb-accent-2) 100%);
    }

    .sidebar {
        width: 280px;
        background: var(--sb-bg);
        display: flex;
        flex-direction: column;
        position: fixed;
        height: 100vh;
        overflow-y: auto;
        z-index: 1000;
        /* Subtle colored glow on the right edge */
        box-shadow: 4px 0 24px rgba(231, 84, 128, 0.05);
        border-right: 1px solid rgba(255, 255, 255, 0.03);
    }

    /* Custom Scrollbar for sidebar */
    .sidebar::-webkit-scrollbar { width: 4px; }
    .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

    /* Logo Area */
    .sidebar .logo-container {
        padding: 30px 25px;
        position: relative;
    }

    .sidebar .logo-container::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 25px;
        right: 25px;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    }

    .sidebar .logo {
        font-size: 1.6rem;
        font-weight: 800;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 12px;
        letter-spacing: 0.5px;
    }

    .sidebar .logo i {
        color: var(--sb-accent-2);
        font-size: 1.8rem;
        filter: drop-shadow(0 0 8px rgba(231, 84, 128, 0.4));
    }

    .sidebar .logo span {
        background: var(--sb-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Navigation Links */
    .sidebar .nav-links {
        list-style: none;
        padding: 20px 15px;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .sidebar .nav-links > li > a {
        display: flex;
        align-items: center;
        padding: 14px 20px;
        color: var(--sb-text);
        text-decoration: none;
        font-weight: 500;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    /* Icon styling */
    .sidebar .nav-links li a i:first-child {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        margin-right: 12px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    /* Hover State */
    .sidebar .nav-links > li > a:hover {
        color: var(--sb-text-hover);
        background: rgba(255, 255, 255, 0.03);
        transform: translateX(5px);
    }

    .sidebar .nav-links > li > a:hover i:first-child {
        background: rgba(255, 255, 255, 0.1);
        color: var(--sb-accent-1);
    }

    /* Active State - The Floating Gradient Pill */
    .sidebar .nav-links > li.active > a {
        color: white;
        background: var(--sb-gradient);
        box-shadow: 0 8px 16px rgba(231, 84, 128, 0.25);
        font-weight: 600;
        transform: translateX(5px);
    }

    .sidebar .nav-links > li.active > a i:first-child {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }

    /* Arrow for dropdowns */
    .sidebar .arrow {
        margin-left: auto;
        font-size: 0.8rem !important;
        transition: transform 0.3s ease;
    }

    /* Submenu Styling */
    .sidebar .submenu ul {
        list-style: none;
        padding: 8px 0;
        margin: 5px 0 10px 0;
        background: rgba(0, 0, 0, 0.2);
        border-radius: 12px;
        display: none;
    }
    
    .sidebar .submenu:hover ul, 
    .sidebar .submenu.active ul {
        display: block; 
        animation: fadeIn 0.3s ease-in-out;
    }

    .sidebar .submenu:hover > a .arrow {
        transform: rotate(180deg);
    }

    .sidebar .submenu ul li a {
        padding: 10px 20px 10px 60px; 
        font-size: 0.85rem;
        color: #71717a;
        text-decoration: none;
        display: block;
        transition: all 0.2s ease;
        position: relative;
    }

    /* Custom bullet point for submenu items */
    .sidebar .submenu ul li a::before {
        content: '';
        position: absolute;
        left: 36px;
        top: 50%;
        transform: translateY(-50%);
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #4b5563;
        transition: all 0.2s ease;
    }

    .sidebar .submenu ul li a:hover {
        color: white;
        transform: translateX(3px);
    }

    .sidebar .submenu ul li a:hover::before {
        background: var(--sb-accent-1);
        box-shadow: 0 0 8px var(--sb-accent-1);
    }

    .sidebar .submenu ul li.active a {
        color: var(--sb-accent-1);
        font-weight: 600;
    }

    .sidebar .submenu ul li.active a::before {
        background: var(--sb-accent-1);
        box-shadow: 0 0 8px var(--sb-accent-1);
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="sidebar">
    <div class="logo-container">
        <a href="#" class="logo">
            <i class="fas fa-threads"></i>
            <span>HappilyWeds</span>
        </a>
    </div>
    <ul class="nav-links">
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        @can('Manage Profiles')
        <li class="{{ request()->routeIs('admin.profiles.*') ? 'active' : '' }}">
            <a href="{{ route('admin.profiles.index') }}">
                <i class="bi bi-person-badge"></i>
                <span>Profiles</span>
            </a>
        </li>
        @endcan
        
        @can('Manage Users')
        <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}">
                <i class="bi bi-people-fill"></i>
                <span>Users</span>
            </a>
        </li>
        @endcan
        
        @can('Manage Roles')
        <li class="{{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
            <a href="{{ route('admin.roles.index') }}">
                <i class="bi bi-shield-lock"></i>
                <span>Roles</span>
            </a>
        </li>
        @endcan
        
        @can('Manage Permissions')
        <li class="{{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
            <a href="{{ route('admin.permissions.index') }}">
                <i class="bi bi-shield-lock-fill"></i>
                <span>Permissions</span>
            </a>
        </li>
        @endcan
        
        {{-- MASTER SETTINGS --}}
        @can('Manage Masters')
        <li class="submenu 
            {{ request()->routeIs('admin.educations.*') ||
               request()->routeIs('admin.occupations.*') ||
               request()->routeIs('admin.areas.*') ||
               request()->routeIs('admin.castes.*') ||
               request()->routeIs('admin.country-codes.*') ||
               request()->routeIs('admin.gotras.*') ?
               'active' : '' }}">

            <a href="#">
                <i class="bi bi-sliders"></i>
                <span>Masters</span>
                <i class="bi bi-chevron-down arrow"></i>
            </a>

            <ul>
                <li class="{{ request()->routeIs('admin.country-codes.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.country-codes.index') }}">
                        🌍 Country Codes
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.educations.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.educations.index') }}">
                        🎓 Highest Qualification
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.occupations.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.occupations.index') }}">
                        💼 Occupations
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.areas.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.areas.index') }}">
                        📍 Areas
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.castes.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.castes.index') }}">
                        🧬 Castes
                    </a>
                </li>
                
                <li class="{{ request()->routeIs('admin.gotras.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.gotras.index') }}">
                        🧬 Gotras
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.refer-by.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.refer-by.index') }}">
                        🔗 Refer By
                    </a>
                </li>
            </ul>
        </li>
        @endcan

    </ul>
</div>