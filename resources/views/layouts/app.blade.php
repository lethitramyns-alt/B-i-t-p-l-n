<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Khám phá những điểm đến du lịch tuyệt đẹp tại Việt Nam - Du Lịch Việt Nam">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Du Lịch Việt Nam') | Du Lịch Việt Nam</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --primary: #0ea5e9;
            --primary-dark: #0284c7;
            --secondary: #f97316;
            --accent: #10b981;
            --dark: #0f172a;
            --dark2: #1e293b;
            --gray: #64748b;
            --light: #f8fafc;
            --border: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0,0,0,.1), 0 2px 4px -1px rgba(0,0,0,.06);
            --shadow-lg: 0 20px 25px -5px rgba(0,0,0,.1), 0 10px 10px -5px rgba(0,0,0,.04);
            --radius: 12px;
            --radius-sm: 8px;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }

        /* NAVBAR */
        .navbar {
            background: rgba(15,23,42,0.95);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 68px;
        }
        .nav-logo {
            display: flex;
            align-items: center;
            gap: .75rem;
            text-decoration: none;
        }
        .nav-logo-icon {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
        }
        .nav-logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            line-height: 1.2;
        }
        .nav-logo-sub { font-size: .65rem; color: var(--primary); font-family: 'Inter', sans-serif; font-weight: 500; letter-spacing: 1px; text-transform: uppercase; }
        .nav-links { display: flex; align-items: center; gap: .25rem; }
        .nav-links a {
            color: rgba(255,255,255,.8);
            text-decoration: none;
            padding: .5rem .9rem;
            border-radius: var(--radius-sm);
            font-size: .9rem;
            font-weight: 500;
            transition: all .2s;
        }
        .nav-links a:hover, .nav-links a.active { color: white; background: rgba(255,255,255,.1); }
        .nav-actions { display: flex; align-items: center; gap: .75rem; }
        .btn { display: inline-flex; align-items: center; gap: .4rem; padding: .55rem 1.1rem; border-radius: var(--radius-sm); font-size: .875rem; font-weight: 600; text-decoration: none; cursor: pointer; border: none; transition: all .2s; }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; }
        .btn-primary:hover { opacity: .9; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(14,165,233,.4); }
        .btn-outline { background: transparent; color: rgba(255,255,255,.85); border: 1px solid rgba(255,255,255,.2); }
        .btn-outline:hover { background: rgba(255,255,255,.1); color: white; }
        .btn-danger { background: #ef4444; color: white; }
        .btn-danger:hover { background: #dc2626; }
        .btn-success { background: var(--accent); color: white; }
        .btn-success:hover { background: #059669; }
        .btn-secondary { background: var(--secondary); color: white; }
        .btn-secondary:hover { background: #ea6c0a; }
        .btn-sm { padding: .35rem .8rem; font-size: .8rem; }
        .btn-lg { padding: .75rem 1.75rem; font-size: 1rem; }

        /* USER DROPDOWN */
        .user-menu { position: relative; }
        .user-btn {
            display: flex; align-items: center; gap: .5rem;
            color: white; cursor: pointer; padding: .4rem .8rem;
            border-radius: var(--radius-sm); background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.1);
            transition: all .2s;
        }
        .user-btn:hover { background: rgba(255,255,255,.15); }
        .user-avatar { width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--accent)); display: flex; align-items: center; justify-content: center; font-size: .85rem; font-weight: 700; color: white; }
        .user-dropdown {
            display: none; position: absolute; right: 0; top: calc(100% + .5rem);
            background: white; border-radius: var(--radius); min-width: 200px;
            box-shadow: var(--shadow-lg); border: 1px solid var(--border);
            overflow: hidden; z-index: 100;
        }
        .user-menu:hover .user-dropdown { display: block; }
        .dropdown-item { display: flex; align-items: center; gap: .6rem; padding: .75rem 1rem; color: var(--dark); text-decoration: none; font-size: .875rem; transition: background .15s; }
        .dropdown-item:hover { background: var(--light); }
        .dropdown-item i { color: var(--gray); width: 16px; }
        .dropdown-divider { border-top: 1px solid var(--border); margin: .25rem 0; }

        /* ALERT / FLASH */
        .flash-messages { position: fixed; top: 80px; right: 1.5rem; z-index: 9999; display: flex; flex-direction: column; gap: .5rem; }
        .flash { padding: .9rem 1.25rem; border-radius: var(--radius-sm); font-size: .875rem; font-weight: 500; display: flex; align-items: center; gap: .6rem; box-shadow: var(--shadow-lg); animation: slideIn .3s ease; max-width: 360px; }
        .flash-success { background: #ecfdf5; color: #065f46; border-left: 4px solid #10b981; }
        .flash-error { background: #fef2f2; color: #991b1b; border-left: 4px solid #ef4444; }
        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }

        /* FOOTER */
        footer {
            background: var(--dark);
            color: rgba(255,255,255,.7);
            margin-top: 5rem;
        }
        .footer-grid { max-width: 1280px; margin: 0 auto; padding: 3rem 1.5rem 1.5rem; display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 2rem; }
        .footer-brand p { font-size: .875rem; line-height: 1.7; margin-top: 1rem; }
        .footer-title { color: white; font-weight: 600; margin-bottom: 1rem; font-size: .95rem; }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: .5rem; }
        .footer-links a { color: rgba(255,255,255,.6); text-decoration: none; font-size: .875rem; transition: color .15s; }
        .footer-links a:hover { color: var(--primary); }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,.08); padding: 1.25rem 1.5rem; text-align: center; font-size: .8rem; max-width: 1280px; margin: 0 auto; }
        .social-links { display: flex; gap: .75rem; margin-top: 1rem; }
        .social-link { width: 36px; height: 36px; border-radius: 8px; background: rgba(255,255,255,.08); display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,.7); text-decoration: none; transition: all .2s; }
        .social-link:hover { background: var(--primary); color: white; }

        /* MOBILE HAMBURGER */
        .hamburger { display: none; background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; }
        .mobile-nav { display: none; }

        /* CONTAINER */
        .container { max-width: 1280px; margin: 0 auto; padding: 0 1.5rem; }
        .section { padding: 4rem 0; }
        .section-header { text-align: center; margin-bottom: 3rem; }
        .section-title { font-family: 'Playfair Display', serif; font-size: 2.25rem; font-weight: 700; color: var(--dark); }
        .section-subtitle { color: var(--gray); margin-top: .5rem; font-size: 1.05rem; }
        .badge { display: inline-flex; align-items: center; gap: .3rem; padding: .25rem .75rem; border-radius: 999px; font-size: .75rem; font-weight: 600; }
        .badge-primary { background: #dbeafe; color: #1d4ed8; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-orange { background: #ffedd5; color: #9a3412; }

        /* CARD */
        .card { background: white; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; transition: all .3s; }
        .card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }

        /* PAGINATION */
        .pagination { display: flex; gap: .5rem; justify-content: center; margin-top: 2rem; flex-wrap: wrap; }
        .page-btn { padding: .5rem .85rem; border-radius: var(--radius-sm); border: 1px solid var(--border); background: white; color: var(--dark); text-decoration: none; font-size: .875rem; font-weight: 500; transition: all .15s; }
        .page-btn:hover, .page-btn.active { background: var(--primary); color: white; border-color: var(--primary); }

        /* TABLE */
        .table-wrap { background: white; border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        thead th { background: var(--dark); color: white; padding: 1rem 1.25rem; text-align: left; font-size: .8rem; font-weight: 600; letter-spacing: .5px; text-transform: uppercase; }
        tbody tr { border-bottom: 1px solid var(--border); transition: background .15s; }
        tbody tr:hover { background: #f8fafc; }
        tbody td { padding: .85rem 1.25rem; font-size: .875rem; color: var(--dark); }

        /* FORM */
        .form-group { margin-bottom: 1.25rem; }
        .form-label { display: block; font-size: .875rem; font-weight: 600; margin-bottom: .4rem; color: var(--dark2); }
        .form-control {
            width: 100%; padding: .65rem 1rem; border: 1px solid var(--border); border-radius: var(--radius-sm);
            font-size: .9rem; color: var(--dark); background: white; transition: border-color .2s;
            font-family: 'Inter', sans-serif;
        }
        .form-control:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(14,165,233,.15); }
        .form-error { color: #ef4444; font-size: .8rem; margin-top: .3rem; }
        .form-hint { color: var(--gray); font-size: .8rem; margin-top: .3rem; }
        textarea.form-control { resize: vertical; min-height: 100px; }
        select.form-control { cursor: pointer; }
        .form-check { display: flex; align-items: center; gap: .6rem; cursor: pointer; }
        .form-check input { width: 18px; height: 18px; cursor: pointer; accent-color: var(--primary); }

        /* GRID */
        .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
        .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .grid-4 { grid-template-columns: repeat(2, 1fr); }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 768px) {
            .nav-links, .nav-actions { display: none; }
            .hamburger { display: block; }
            .mobile-nav { display: none; background: var(--dark2); padding: 1rem 1.5rem; }
            .mobile-nav.open { display: block; }
            .mobile-nav a { display: block; color: rgba(255,255,255,.8); text-decoration: none; padding: .75rem 0; border-bottom: 1px solid rgba(255,255,255,.05); font-size: .95rem; }
            .grid-2, .grid-3, .grid-4 { grid-template-columns: 1fr; }
            .section-title { font-size: 1.75rem; }
            .footer-grid { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="nav-logo">
                <div class="nav-logo-icon">🌏</div>
                <div>
                    <div class="nav-logo-text">Du Lịch Việt</div>
                    <div class="nav-logo-sub">Vietnam Tourism</div>
                </div>
            </a>

            <div class="nav-links">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Trang chủ
                </a>
                <a href="{{ route('destinations.index') }}" class="{{ request()->routeIs('destinations.*') ? 'active' : '' }}">
                    <i class="fas fa-map-marker-alt"></i> Điểm đến
                </a>
                @auth
                <a href="{{ route('favorites.index') }}" class="{{ request()->routeIs('favorites.*') ? 'active' : '' }}">
                    <i class="fas fa-heart"></i> Yêu thích
                </a>
                @endauth
            </div>

            <div class="nav-actions">
                @auth
                    <div class="user-menu">
                        <div class="user-btn">
                            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                            <span style="font-size:.85rem;">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down" style="font-size:.7rem;opacity:.6;"></i>
                        </div>
                        <div class="user-dropdown">
                            @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                <i class="fas fa-tachometer-alt"></i> Admin Dashboard
                            </a>
                            <div class="dropdown-divider"></div>
                            @endif
                            <a href="{{ route('favorites.index') }}" class="dropdown-item">
                                <i class="fas fa-heart"></i> Yêu thích của tôi
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item" style="width:100%;text-align:left;background:none;border:none;cursor:pointer;">
                                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline btn-sm">
                        <i class="fas fa-sign-in-alt"></i> Đăng nhập
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-user-plus"></i> Đăng ký
                    </a>
                @endauth

                <button class="hamburger" onclick="toggleMobile()">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Nav -->
        <div class="mobile-nav" id="mobileNav">
            <a href="{{ route('home') }}">🏠 Trang chủ</a>
            <a href="{{ route('destinations.index') }}">🗺️ Điểm đến</a>
            @auth
            <a href="{{ route('favorites.index') }}">❤️ Yêu thích</a>
            @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}">⚙️ Admin</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" style="border-bottom: 1px solid rgba(255,255,255,.05); padding: .75rem 0;">
                @csrf
                <button type="submit" style="background:none;border:none;color:rgba(255,255,255,.8);cursor:pointer;font-size:.95rem;">🚪 Đăng xuất</button>
            </form>
            @else
            <a href="{{ route('login') }}">🔑 Đăng nhập</a>
            <a href="{{ route('register') }}">✨ Đăng ký</a>
            @endauth
        </div>
    </nav>

    <!-- FLASH MESSAGES -->
    <div class="flash-messages" id="flashMessages">
        @if(session('success'))
        <div class="flash flash-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="flash flash-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
        @endif
    </div>

    <!-- CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="nav-logo" style="margin-bottom:1rem;">
                    <div class="nav-logo-icon">🌏</div>
                    <div>
                        <div class="nav-logo-text">Du Lịch Việt</div>
                        <div class="nav-logo-sub">Vietnam Tourism</div>
                    </div>
                </a>
                <p>Khám phá những điểm đến tuyệt vời nhất Việt Nam. Chúng tôi giúp bạn tìm kiếm và lưu trữ những địa điểm du lịch đáng nhớ.</p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
            <div>
                <div class="footer-title">Khám phá</div>
                <ul class="footer-links">
                    <li><a href="{{ route('destinations.index') }}">Tất cả điểm đến</a></li>
                    <li><a href="{{ route('destinations.index') }}?region=1">Miền Bắc</a></li>
                    <li><a href="{{ route('destinations.index') }}?region=3">Miền Trung</a></li>
                    <li><a href="{{ route('destinations.index') }}?region=2">Miền Nam</a></li>
                </ul>
            </div>
            <div>
                <div class="footer-title">Tài khoản</div>
                <ul class="footer-links">
                    @auth
                    <li><a href="{{ route('favorites.index') }}">Yêu thích</a></li>
                    @else
                    <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                    <li><a href="{{ route('register') }}">Đăng ký</a></li>
                    @endauth
                </ul>
            </div>
            <div>
                <div class="footer-title">Liên hệ</div>
                <ul class="footer-links">
                    <li><a href="#">📧 contact@dulichviet.vn</a></li>
                    <li><a href="#">📞 1900 xxxx</a></li>
                    <li><a href="#">📍 Việt Nam</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} Du Lịch Việt Nam. Made with ❤️ in Vietnam</p>
        </div>
    </footer>

    <script>
        function toggleMobile() {
            const nav = document.getElementById('mobileNav');
            nav.classList.toggle('open');
        }
        // Auto-hide flash messages
        setTimeout(() => {
            const msgs = document.getElementById('flashMessages');
            if (msgs) msgs.style.opacity = '0';
        }, 4000);
        setTimeout(() => {
            const msgs = document.getElementById('flashMessages');
            if (msgs) msgs.style.display = 'none';
        }, 4500);
    </script>
    @stack('scripts')
</body>
</html>
