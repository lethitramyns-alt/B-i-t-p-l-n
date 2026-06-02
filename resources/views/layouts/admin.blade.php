<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin Du Lịch</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #0ea5e9;
            --dark: #0f172a;
            --light: #f8fafc;
            --border: #e2e8f0;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f1f5f9; color: #1e293b; display: flex; }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--dark);
            height: 100vh;
            position: fixed;
            color: white;
            padding: 1.5rem 0;
            display: flex;
            flex-direction: column;
        }
        .sidebar-brand { padding: 0 1.5rem 2rem; font-size: 1.25rem; font-weight: 700; color: var(--primary); display: flex; align-items: center; gap: .75rem; }
        .sidebar-menu { list-style: none; flex: 1; }
        .sidebar-link {
            display: flex; align-items: center; gap: .75rem; padding: .85rem 1.5rem;
            color: #94a3b8; text-decoration: none; transition: all .2s; font-size: .9rem;
        }
        .sidebar-link:hover, .sidebar-link.active { background: rgba(255,255,255,.05); color: white; border-left: 4px solid var(--primary); }
        .sidebar-link i { width: 20px; }

        /* Main Content */
        .main-content { margin-left: var(--sidebar-width); flex: 1; min-height: 100vh; }
        .topbar {
            height: 64px; background: white; border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between; padding: 0 2rem;
            position: sticky; top: 0; z-index: 100;
        }
        .page-body { padding: 2rem; }
        
        /* Components */
        .card { background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,.1); padding: 1.5rem; margin-bottom: 1.5rem; }
        .btn { padding: .6rem 1.2rem; border-radius: 8px; font-weight: 600; cursor: pointer; border: none; font-size: .875rem; text-decoration: none; display: inline-flex; align-items: center; gap: .5rem; transition: .2s; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-danger { background: #ef4444; color: white; }
        .table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        .table th { text-align: left; padding: 1rem; border-bottom: 2px solid var(--border); font-size: .8rem; color: #64748b; text-transform: uppercase; }
        .table td { padding: 1rem; border-bottom: 1px solid var(--border); font-size: .9rem; }
        
        /* Stats */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: white; padding: 1.5rem; border-radius: 12px; display: flex; align-items: center; gap: 1rem; }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-brand">🌏 Admin Tour</div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-th-large"></i> Thống kê</a></li>
            <li><a href="{{ route('admin.destinations.index') }}" class="sidebar-link {{ request()->routeIs('admin.destinations.*') ? 'active' : '' }}"><i class="fas fa-map-marked-alt"></i> Điểm đến</a></li>
            <li><a href="{{ route('admin.regions.index') }}" class="sidebar-link {{ request()->routeIs('admin.regions.*') ? 'active' : '' }}"><i class="fas fa-layer-group"></i> Khu vực</a></li>
            <li><a href="{{ route('admin.types.index') }}" class="sidebar-link {{ request()->routeIs('admin.types.*') ? 'active' : '' }}"><i class="fas fa-tags"></i> Loại hình</a></li>
            <li><a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i class="fas fa-users"></i> Người dùng</a></li>
            <li><a href="{{ route('home') }}" class="sidebar-link"><i class="fas fa-external-link-alt"></i> Xem Website</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <div style="font-weight: 600;">@yield('page_title')</div>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <span>{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit" class="btn" style="background:none; color:#ef4444;"><i class="fas fa-sign-out-alt"></i></button></form>
            </div>
        </header>
        <div class="page-body">
            @if(session('success'))
                <div style="background:#dcfce7; color:#166534; padding:1rem; border-radius:8px; margin-bottom:1.5rem;">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div style="background:#fee2e2; color:#991b1b; padding:1rem; border-radius:8px; margin-bottom:1.5rem;">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div style="background:#fee2e2; color:#991b1b; padding:1rem; border-radius:8px; margin-bottom:1.5rem;">
                    <div style="font-weight:700; margin-bottom:.5rem;">Vui lòng kiểm tra lại thông tin:</div>
                    <ul style="padding-left:1.25rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </div>
    </main>
</body>
</html>
