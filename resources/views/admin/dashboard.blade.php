@extends('layouts.landing')

@section('content')
    <style>
        .admin-header {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.08) 0%, rgba(245, 158, 11, 0.08) 50%, rgba(79, 70, 229, 0.06) 100%);
            border-radius: 24px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        .admin-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(239, 68, 68, 0.15) 0%, transparent 70%);
        }
        .admin-title {
            background: linear-gradient(135deg, #ef4444 0%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .admin-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        .admin-link {
            display: flex;
            align-items: center;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            text-decoration: none;
            color: #1e293b;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .admin-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 0;
            background: linear-gradient(135deg, #ef4444, #f59e0b);
            transition: width 0.3s ease;
        }
        .admin-link:hover {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.08) 0%, rgba(245, 158, 11, 0.08) 100%);
            transform: translateX(8px);
            color: #1e293b;
        }
        .admin-link:hover::before {
            width: 4px;
        }
        .admin-link:last-child {
            border-bottom: none;
        }
        .admin-link .icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-right: 1rem;
            transition: all 0.3s ease;
        }
        .admin-link:hover .icon {
            transform: scale(1.1);
        }
        .icon-users {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.15) 0%, rgba(124, 58, 237, 0.15) 100%);
            color: #4f46e5;
        }
        .icon-lawyers {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.15) 100%);
            color: #10b981;
        }
        .icon-articles {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(37, 99, 235, 0.15) 100%);
            color: #3b82f6;
        }
        .icon-dev {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, rgba(217, 119, 6, 0.15) 100%);
            color: #f59e0b;
        }
        .admin-link-text {
            font-weight: 600;
            font-size: 1rem;
        }
        .admin-link-arrow {
            margin-left: auto;
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.3s ease;
            color: #64748b;
        }
        .admin-link:hover .admin-link-arrow {
            opacity: 1;
            transform: translateX(0);
        }
        html[data-theme="dark"] .admin-header {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(245, 158, 11, 0.12) 50%, rgba(79, 70, 229, 0.1) 100%);
        }
        html[data-theme="dark"] .admin-card {
            background: rgba(30, 41, 59, 0.85);
            border-color: rgba(255, 255, 255, 0.1);
        }
        html[data-theme="dark"] .admin-link {
            color: #e2e8f0;
            border-color: rgba(255, 255, 255, 0.05);
        }
        html[data-theme="dark"] .admin-link:hover {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(245, 158, 11, 0.12) 100%);
            color: #e2e8f0;
        }
    </style>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="admin-header reveal text-center">
                    <h1 class="display-5 fw-bold admin-title mb-2">Admin Dashboard</h1>
                    <p class="text-muted mb-0">Manage your LawLite platform</p>
                </div>

                <div class="admin-card reveal" style="animation-delay: 0.1s;">
                    <a href="{{ route('admin.users.index') }}" class="admin-link">
                        <div class="icon icon-users">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <span class="admin-link-text">Manage Users</span>
                        <i class="bi bi-arrow-right admin-link-arrow"></i>
                    </a>
                    <a href="{{ route('admin.verification.index') }}" class="admin-link">
                        <div class="icon icon-lawyers">
                            <i class="bi bi-patch-check-fill"></i>
                        </div>
                        <span class="admin-link-text">Manage Lawyers</span>
                        <i class="bi bi-arrow-right admin-link-arrow"></i>
                    </a>
                    <a href="{{ route('admin.articles.index') }}" class="admin-link">
                        <div class="icon icon-articles">
                            <i class="bi bi-newspaper"></i>
                        </div>
                        <span class="admin-link-text">Manage Articles</span>
                        <i class="bi bi-arrow-right admin-link-arrow"></i>
                    </a>
                    @if (env('APP_ENV') === 'local')
                    <a href="{{ url('/_dev/login-as/admin') }}" class="admin-link">
                        <div class="icon icon-dev">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <span class="admin-link-text text-warning">Dev: Login as admin</span>
                        <i class="bi bi-arrow-right admin-link-arrow"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
