<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill Assessment PT. MWT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4B49AC;
            --primary-light: #98BDFF;
            --support-blue: #7DA0FA;
            --support-purple: #7978E9;
            --support-red: #F3797E;
            --text-dark: #1f2937;
            --muted: #94a3b8;
            --body-bg: #edf2f0;
            --dark-1: #14162f;
            --dark-2: #1e2148;
            --sidebar-expanded: 280px;
            --sidebar-collapsed: 84px;
            --topbar-height: 92px;
            --shadow-soft: 0 10px 30px rgba(75, 73, 172, 0.10);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
            overflow-x: hidden;
        }

        body {
            margin: 0;
            background: var(--body-bg);
            color: var(--text-dark);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        a {
            text-decoration: none;
        }

        .app-layout {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-expanded);
            min-width: var(--sidebar-expanded);
            height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(125, 160, 250, 0.22), transparent 34%),
                linear-gradient(180deg, #14162f 0%, #1e2148 55%, #15172f 100%);
            color: #fff;
            padding: 18px 14px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            overflow-x: visible;
            z-index: 1000;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            transition: width .24s ease, min-width .24s ease, padding .24s ease, transform .24s ease;
            display: flex;
            flex-direction: column;
        }

        .sidebar-bottom {
            margin-top: auto;
        }

        .logout-bottom {
            margin-top: auto;
        }
        
        .brand-area {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 10px 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.10);
            margin-bottom: 18px;
            min-height: 78px;
        }

        .sigma-logo {
            width: 50px;
            height: 50px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--primary), var(--support-blue), var(--support-red));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 18px;
            box-shadow: 0 14px 28px rgba(125, 160, 250, 0.25);
            flex-shrink: 0;
        }

        .brand-text {
            min-width: 0;
            transition: opacity .18s ease, width .18s ease;
        }

        .brand-name {
            font-size: 22px;
            font-weight: 850;
            line-height: 1;
            margin: 0;
            letter-spacing: -0.5px;
            color: #fff;
            white-space: nowrap;
        }

        .brand-name span {
            background: linear-gradient(90deg, var(--support-blue), var(--support-red));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-subtitle {
            margin: 4px 0 0;
            font-size: 12px;
            color: #cbd5e1;
            white-space: nowrap;
        }

        .menu-section {
            margin-bottom: 22px;
        }

        .menu-title {
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .8px;
            color: #94a3b8;
            text-transform: uppercase;
            margin: 0 10px 10px;
            transition: opacity .18s ease;
        }

        .sidebar .nav-link,
        .logout-link {
            position: relative;
            color: #d1d5db;
            border-radius: 14px;
            padding: 12px 14px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: .22s ease;
            font-weight: 700;
            font-size: 15px;
            min-height: 48px;
            white-space: nowrap;
        }

        .sidebar .nav-link i,
        .logout-link i {
            font-size: 18px;
            width: 22px;
            min-width: 22px;
            text-align: center;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(125, 160, 250, 0.14);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background: linear-gradient(90deg, rgba(75, 73, 172, 0.55), rgba(125, 160, 250, 0.26));
            font-weight: 850;
            box-shadow: 0 10px 24px rgba(75, 73, 172, 0.20);
        }

        .sidebar .nav-link.active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 11px;
            bottom: 11px;
            width: 4px;
            border-radius: 999px;
            background: linear-gradient(180deg, var(--support-blue), var(--support-red));
        }

        .menu-badge {
            margin-left: auto;
            min-width: 24px;
            height: 24px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--support-red), var(--support-purple));
            color: #fff;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
        }

        .logout-link {
            border: none;
            width: 100%;
            background: transparent;
            color: #fecaca;
            text-align: left;
        }

        .logout-link:hover {
            background: rgba(243, 121, 126, 0.16);
            color: #fff;
        }

        body.sidebar-collapsed .sidebar {
            width: var(--sidebar-collapsed);
            min-width: var(--sidebar-collapsed);
            padding-left: 12px;
            padding-right: 12px;
        }

        body.sidebar-collapsed .brand-area {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        body.sidebar-collapsed .brand-text,
        body.sidebar-collapsed .menu-title,
        body.sidebar-collapsed .sidebar .nav-link span:not(.menu-badge),
        body.sidebar-collapsed .logout-link span {
            opacity: 0;
            width: 0;
            overflow: hidden;
            pointer-events: none;
        }

        body.sidebar-collapsed .sidebar .nav-link,
        body.sidebar-collapsed .logout-link {
            justify-content: center;
            padding: 12px;
            gap: 0;
        }

        body.sidebar-collapsed .menu-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            min-width: 18px;
            height: 18px;
            font-size: 10px;
            padding: 0 5px;
        }

        .main-area {
            flex: 1;
            min-width: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin-left: var(--sidebar-expanded);
            transition: margin-left .24s ease;
        }

        body.sidebar-collapsed .main-area {
            margin-left: var(--sidebar-collapsed);
        }

        .topbar {
            background:
                radial-gradient(circle at top right, rgba(243, 121, 126, 0.20), transparent 30%),
                linear-gradient(135deg, #14162f 0%, #1f2352 55%, #171933 100%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding: 0;
            position: fixed;
            top: 0;
            left: var(--sidebar-expanded);
            right: 0;
            z-index: 999;
            box-shadow: 0 12px 30px rgba(20, 22, 47, 0.18);
            transition: left .24s ease;
        }

        body.sidebar-collapsed .topbar {
            left: var(--sidebar-collapsed);
        }

        .topbar-shell {
            width: 100%;
            min-height: var(--topbar-height);
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            min-width: 0;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
            flex-shrink: 0;
        }

        .sidebar-toggle {
            width: 48px;
            height: 48px;
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 16px;
            background: rgba(255, 255, 255, .09);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            transition: .22s ease;
            cursor: pointer;
            flex-shrink: 0;
        }

        .sidebar-toggle:hover {
            background: rgba(255, 255, 255, .16);
            transform: translateY(-1px);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 16px;
            flex: 1;
            min-width: 0;
        }

        .system-info-group {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0;
            min-width: 0;
            max-width: 100%;
            padding: 0 4px;
        }

        .system-info-item {
            position: relative;
            display: flex;
            align-items: center;
            gap: 9px;
            min-height: 44px;
            padding: 0 16px;
            color: #fff;
            text-decoration: none;
            border-right: 1px solid rgba(255, 255, 255, 0.10);
            transition: .2s ease;
            background: transparent;
            flex-shrink: 0;
        }

        .system-info-item:last-child {
            border-right: none;
        }

        .system-info-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.055);
            border-radius: 12px;
        }

        .system-info-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.09);
            color: #c7d2fe;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .system-info-label {
            font-size: 10px;
            color: #94a3b8;
            font-weight: 850;
            letter-spacing: .35px;
            text-transform: uppercase;
            line-height: 1;
            margin-bottom: 4px;
        }

        .system-info-value {
            font-size: 13px;
            color: #f8fafc;
            font-weight: 850;
            line-height: 1.1;
            white-space: nowrap;
        }

        .system-active {
            color: #86efac;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .system-active::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.14);
        }

        .system-notif-count {
            position: absolute;
            top: -3px;
            right: 4px;
            min-width: 18px;
            height: 18px;
            padding: 0 5px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--support-red), var(--support-purple));
            color: #fff;
            font-size: 10px;
            font-weight: 900;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #1f2352;
        }

        .profile-dropdown {
            flex-shrink: 0;
        }

        .profile-dropdown .dropdown-toggle::after {
            display: none;
        }

        .profile-chip {
            min-width: 210px;
            max-width: 260px;
            min-height: 54px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 20px;
            padding: 7px 12px 7px 7px;
            background: rgba(255, 255, 255, 0.13);
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            transition: .22s ease;
        }

        .profile-chip:hover {
            background: rgba(255, 255, 255, 0.18);
            transform: translateY(-1px);
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--support-blue), var(--support-red));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            flex-shrink: 0;
        }

        .profile-text {
            text-align: left;
            min-width: 0;
            flex: 1;
        }

        .profile-name {
            font-size: 13px;
            font-weight: 850;
            margin: 0;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.2;
        }

        .profile-role {
            font-size: 11px;
            color: #cbd5e1;
            margin: 2px 0 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-transform: capitalize;
        }

        .profile-arrow {
            font-size: 13px;
            color: #cbd5e1;
            flex-shrink: 0;
        }

        .profile-dropdown .dropdown-menu {
            border: none;
            border-radius: 18px;
            padding: 10px;
            box-shadow: 0 18px 40px rgba(20, 22, 47, 0.18);
            min-width: 220px;
        }

        .profile-dropdown .dropdown-item {
            border-radius: 12px;
            padding: 10px 12px;
            font-size: 14px;
            font-weight: 650;
        }

        .profile-dropdown .dropdown-item i {
            margin-right: 8px;
        }

        .content-wrapper {
            width: 100%;
            min-width: 0;
            padding: calc(var(--topbar-height) + 16px) 14px 14px 14px;
        }

        .page-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: var(--shadow-soft);
            border: none;
        }

        .stat-card {
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            min-height: 130px;
        }

        .stat-card .card-body {
            padding: 22px;
        }

        .stat-label {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 38px;
            font-weight: 800;
            color: #fff;
            line-height: 1;
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.16);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .bg-stat-1 {
            background: linear-gradient(135deg, #7DA0FA 0%, #98BDFF 100%);
        }

        .bg-stat-2 {
            background: linear-gradient(135deg, #4B49AC 0%, #5D5FEF 100%);
        }

        .bg-stat-3 {
            background: linear-gradient(135deg, #9C9AFF 0%, #7978E9 100%);
        }

        .bg-stat-4 {
            background: linear-gradient(135deg, #F3797E 0%, #E85D75 100%);
        }

        .section-title {
            font-size: 18px;
            font-weight: 750;
            margin-bottom: 16px;
        }

        .soft-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(75, 73, 172, 0.10);
            color: var(--primary);
            border-radius: 999px;
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 650;
        }

        .sidebar-floating-tooltip {
            position: fixed;
            left: calc(var(--sidebar-collapsed) + 18px);
            top: 0;
            transform: translateY(-50%) translateX(-6px);
            min-width: 170px;
            padding: 11px 14px;
            border-radius: 14px;
            background: linear-gradient(135deg, #ffffff 0%, #f7f8ff 100%);
            color: #1e2148;
            border: 1px solid rgba(75, 73, 172, 0.18);
            box-shadow: 0 18px 36px rgba(20, 22, 47, 0.24);
            font-size: 13px;
            font-weight: 850;
            letter-spacing: .1px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            z-index: 5000;
            transition: opacity .16s ease, transform .16s ease;
        }

        .sidebar-floating-tooltip.show {
            opacity: 1;
            transform: translateY(-50%) translateX(0);
        }

        .sidebar-floating-tooltip::before {
            content: "";
            position: absolute;
            left: -7px;
            top: 50%;
            width: 14px;
            height: 14px;
            background: #ffffff;
            border-left: 1px solid rgba(75, 73, 172, 0.18);
            border-bottom: 1px solid rgba(75, 73, 172, 0.18);
            transform: translateY(-50%) rotate(45deg);
        }

        .sidebar-backdrop {
            display: none;
        }

        @media (max-width: 1280px) and (min-width: 992px) {
            .topbar-shell {
                min-height: auto;
                flex-wrap: wrap;
            }

            .system-info-group {
                flex-wrap: wrap;
                row-gap: 8px;
                justify-content: flex-end;
            }

            .system-info-item {
                min-height: 38px;
            }

            .content-wrapper {
                padding-top: 128px;
            }
        }

        @media (max-width: 991px) {
            :root {
                --sidebar-collapsed: 0px;
                --topbar-height: auto;
            }

            .app-layout {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
                width: 280px;
                min-width: 280px;
            }

            body.mobile-sidebar-open .sidebar {
                transform: translateX(0);
            }

            body.sidebar-collapsed .sidebar {
                width: 280px;
                min-width: 280px;
                padding: 18px 14px;
            }

            body.sidebar-collapsed .brand-area {
                justify-content: flex-start;
            }

            body.sidebar-collapsed .brand-text,
            body.sidebar-collapsed .menu-title,
            body.sidebar-collapsed .sidebar .nav-link span:not(.menu-badge),
            body.sidebar-collapsed .logout-link span {
                opacity: 1;
                width: auto;
                overflow: visible;
                pointer-events: auto;
            }

            body.sidebar-collapsed .sidebar .nav-link,
            body.sidebar-collapsed .logout-link {
                justify-content: flex-start;
                padding: 12px 14px;
                gap: 12px;
            }

            .main-area,
            body.sidebar-collapsed .main-area {
                margin-left: 0;
                width: 100%;
            }

            .topbar,
            body.sidebar-collapsed .topbar {
                position: sticky;
                top: 0;
                left: 0;
                right: auto;
                width: 100%;
                z-index: 999;
            }

            .topbar-shell {
                padding: 10px 14px;
                display: grid;
                grid-template-columns: 52px minmax(0, 1fr);
                gap: 10px;
                align-items: start;
                min-height: 66px;
            }

            .topbar-left {
                grid-column: 1;
                width: 52px;
            }

            .sidebar-toggle {
                width: 44px;
                height: 44px;
                border-radius: 14px;
                position: relative;
                z-index: 1002;
            }

            .topbar-actions {
                grid-column: 2;
                display: none;
                width: 100%;
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
                min-width: 0;
            }

            .topbar:hover .topbar-actions,
            .topbar.mobile-topbar-open .topbar-actions {
                display: flex;
            }

            .system-info-group {
                width: 100%;
                display: grid;
                grid-template-columns: 1fr;
                gap: 6px;
                padding: 8px;
                background: rgba(255, 255, 255, 0.055);
                border: 1px solid rgba(255, 255, 255, 0.09);
                border-radius: 16px;
            }

            .system-info-item {
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
                justify-content: flex-start;
                padding: 8px 10px;
                min-width: 0;
            }

            .system-info-item:last-child {
                border-bottom: none;
            }

            .system-info-value {
                font-size: 12px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .profile-chip {
                width: 100%;
                min-width: 100%;
                max-width: 100%;
                justify-content: space-between;
            }

            .content-wrapper {
                padding: 14px;
                width: 100%;
            }

            .sidebar-backdrop {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(15, 23, 42, .42);
                z-index: 998;
            }

            body.mobile-sidebar-open .sidebar-backdrop {
                display: block;
            }
        }

        @media (max-width: 576px) {
            .topbar-shell {
                grid-template-columns: 50px minmax(0, 1fr);
                gap: 10px;
                padding: 10px;
            }

            .sidebar-toggle {
                width: 44px;
                height: 44px;
            }

            .profile-chip {
                min-height: 50px;
                border-radius: 16px;
            }
        }
    </style>
</head>

<body>
    @php
        $userRole = auth()->user()->role ?? null;

        $unreadNotifCount = auth()->check()
            ? auth()->user()->notifications()->where('is_read', 0)->count()
            : 0;
    @endphp

    <div class="app-layout">
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
        <div class="sidebar-floating-tooltip" id="sidebarFloatingTooltip"></div>

        <aside class="sidebar" id="sidebar">
            <div class="brand-area">
                <div class="sigma-logo">S</div>

                <div class="brand-text">
                    <h1 class="brand-name">Team<span>SIGMA</span></h1>
                    <p class="brand-subtitle">Skill Assessment</p>
                </div>
            </div>

            <div class="menu-section">
                <div class="menu-title">General</div>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        data-tooltip="Dashboard">
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    @if($userRole === 'leader')
                        <li class="nav-item">
                            <a href="{{ route('leader.assessments.index') }}"
                               class="nav-link {{ request()->is('leader-assessments*') ? 'active' : '' }}"
                               data-tooltip="Penilaian Assessment">
                                <i class="bi bi-clipboard2-check-fill"></i>
                                <span>Penilaian Assessment</span>
                            </a>
                        </li>
                    @endif

                    @if(in_array($userRole, ['foreman', 'kabag']))
                        <li class="nav-item">
                            <a href="{{ route('approvals.index') }}"
                               class="nav-link {{ request()->is('approvals*') ? 'active' : '' }}"
                               data-tooltip="Approval Assessment">
                                <i class="bi bi-patch-check-fill"></i>
                                <span>Approval Assessment</span>
                            </a>
                        </li>
                    @endif

                    @if($userRole === 'admin')
                    <div class="menu-title mt-4">Master Data</div>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link submenu-link {{ request()->is('user*') ? 'active' : '' }}" data-tooltip="User Management">
                            <i class="bi bi-person-gear"></i>
                            <span>User Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('operators.index') }}" class="nav-link submenu-link {{ request()->is('operators*') ? 'active' : '' }}" data-tooltip="Master Operator">
                            <i class="bi bi-people-fill"></i>
                            <span>Master Operator</span>
                        </a>
                    </li>
                        <li class="nav-item">
                            <a href="{{ route('leader-assignments.index') }}"
                            class="nav-link {{ request()->is('leader-assignments*') ? 'active' : '' }}">
                                <i class="bi bi-person-workspace"></i>
                                <span>Leader Assignment</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('parts.index') }}" class="nav-link submenu-link {{ request()->is('parts*') ? 'active' : '' }}" data-tooltip="Master Part">
                                <i class="bi bi-box-seam-fill"></i>
                                <span>Master Part</span>
                            </a>
                        </li>
                        <div class="menu-title mt-4">Report</div>
                    @endif
                    @if(in_array($userRole, ['admin']))
                        <li class="nav-item">
                            <a href="{{ Route::has('rekapitulasi.index') ? route('rekapitulasi.index') : '#' }}"
                               class="nav-link {{ request()->is('rekapitulasi*') ? 'active' : '' }}"
                               data-tooltip="Rekapitulasi Data">
                                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                                <span>Rekapitulasi Data</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="menu-section">
                  <div class="menu-title">Tools</div>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('notifications.index') }}"
                           class="nav-link {{ request()->is('notifications*') ? 'active' : '' }}"
                           data-tooltip="Notifikasi">
                            <i class="bi bi-bell-fill"></i>
                            <span>Notifikasi</span>

                            @if($unreadNotifCount > 0)
                                <span class="menu-badge">{{ $unreadNotifCount }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
            <div class="logout-bottom">
                <button type="button"
                        class="logout-link"
                        data-bs-toggle="modal"
                        data-bs-target="#logoutModal"
                        data-tooltip="Log out">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Log out</span>
                </button>
            </div>
        </aside>

        <main class="main-area">
            <div class="topbar" id="topbar">
                <div class="topbar-shell">
                    <div class="topbar-left">
                        <button type="button"
                                class="sidebar-toggle"
                                id="sidebarToggle"
                                aria-label="Toggle sidebar">
                            <i class="bi bi-list"></i>
                        </button>
                    </div>

                    <div class="topbar-actions">
                        <div class="system-info-group">
                            <div class="system-info-item">
                                <div class="system-info-icon">
                                    <i class="bi bi-calendar3"></i>
                                </div>

                                <div>
                                    <div class="system-info-label">Tanggal</div>
                                    <div class="system-info-value">{{ now()->translatedFormat('d F Y') }}</div>
                                </div>
                            </div>

                            <div class="system-info-item">
                                <div class="system-info-icon">
                                    <i class="bi bi-activity"></i>
                                </div>

                                <div>
                                    <div class="system-info-label">Status Sistem</div>
                                    <div class="system-info-value system-active">Aktif</div>
                                </div>
                            </div>

                            <a href="{{ route('notifications.index') }}" class="system-info-item system-info-link">
                                <div class="system-info-icon">
                                    <i class="bi bi-bell"></i>
                                </div>

                                <div>
                                    <div class="system-info-label">Notifikasi</div>
                                    <div class="system-info-value">{{ $unreadNotifCount }} Belum Dibaca</div>
                                </div>

                                @if($unreadNotifCount > 0)
                                    <span class="system-notif-count">{{ $unreadNotifCount }}</span>
                                @endif
                            </a>
                        </div>

                        <div class="dropdown profile-dropdown">
                            <button class="profile-chip dropdown-toggle"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <div class="avatar">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                </div>

                                <div class="profile-text">
                                    <p class="profile-name">{{ auth()->user()->name ?? 'User' }}</p>
                                    <p class="profile-role">{{ auth()->user()->role ?? 'Administrator' }}</p>
                                </div>

                                <i class="bi bi-chevron-down profile-arrow"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <h6 class="dropdown-header">Akun Sistem</h6>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('notifications.index') }}">
                                        <i class="bi bi-bell"></i>
                                        Lihat Notifikasi
                                    </a>
                                </li>

                                <li>
                                    <button type="button"
                                            class="dropdown-item text-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#logoutModal">
                                        <i class="bi bi-box-arrow-right"></i>
                                        Log out
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-wrapper">
                <x-alert />
                @yield('content')
            </div>
        </main>
    </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-body p-4">
                    <div class="text-center mb-3">
                        <div style="width:58px;height:58px;margin:0 auto 14px;border-radius:18px;background:#fff0f1;color:#dc3545;display:flex;align-items:center;justify-content:center;font-size:28px;">
                            <i class="bi bi-box-arrow-right"></i>
                        </div>

                        <h5 class="fw-bold mb-2">Yakin ingin logout?</h5>

                        <p class="text-muted mb-0" style="font-size:14px;">
                            Kamu akan keluar dari sistem Skill Assessment.
                        </p>
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="button"
                                class="btn btn-light rounded-3 flex-fill"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <form action="{{ route('logout') }}" method="POST" class="flex-fill">
                            @csrf

                            <button type="submit" class="btn btn-danger rounded-3 w-100">
                                Ya, Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        (function () {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');
            const sidebarFloatingTooltip = document.getElementById('sidebarFloatingTooltip');

            function isMobileLayout() {
                return window.innerWidth <= 991;
            }

            function showSidebarTooltip(element) {
                if (!sidebarFloatingTooltip) return;
                if (!document.body.classList.contains('sidebar-collapsed')) return;
                if (isMobileLayout()) return;

                const rect = element.getBoundingClientRect();

                sidebarFloatingTooltip.textContent = element.getAttribute('data-tooltip') || '';
                sidebarFloatingTooltip.style.top = (rect.top + rect.height / 2) + 'px';
                sidebarFloatingTooltip.classList.add('show');
            }

            function hideSidebarTooltip() {
                if (!sidebarFloatingTooltip) return;
                sidebarFloatingTooltip.classList.remove('show');
            }

            document.querySelectorAll('.sidebar [data-tooltip]').forEach(function (item) {
                item.addEventListener('mouseenter', function () {
                    showSidebarTooltip(item);
                });

                item.addEventListener('mousemove', function () {
                    showSidebarTooltip(item);
                });

                item.addEventListener('mouseleave', function () {
                    hideSidebarTooltip();
                });
            });

            if (localStorage.getItem('sidebarCollapsed') === 'true' && !isMobileLayout()) {
                document.body.classList.add('sidebar-collapsed');
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function () {
                    if (isMobileLayout()) {
                        document.body.classList.toggle('mobile-sidebar-open');
                        return;
                    }

                    document.body.classList.toggle('sidebar-collapsed');

                    localStorage.setItem(
                        'sidebarCollapsed',
                        document.body.classList.contains('sidebar-collapsed')
                    );
                });
            }

            if (sidebarBackdrop) {
                sidebarBackdrop.addEventListener('click', function () {
                    document.body.classList.remove('mobile-sidebar-open');
                });
            }

            window.addEventListener('resize', function () {
                if (isMobileLayout()) {
                    document.body.classList.remove('sidebar-collapsed');
                } else {
                    document.body.classList.remove('mobile-sidebar-open');

                    if (localStorage.getItem('sidebarCollapsed') === 'true') {
                        document.body.classList.add('sidebar-collapsed');
                    }
                }
            });
        })();
    </script>
     @stack('scripts')
</body>
</html>