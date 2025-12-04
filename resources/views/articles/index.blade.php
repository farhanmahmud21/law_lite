@extends('layouts.landing')

@section('content')
    <style>
        /* Premium Articles Page */
        .articles-hero {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(79, 70, 229, 0.08) 50%, rgba(245, 158, 11, 0.08) 100%);
            border-radius: 24px;
            padding: 3rem 2rem;
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .articles-hero::before {
            content: '';
            position: absolute;
            top: -30%;
            left: -10%;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.2) 0%, transparent 70%);
            animation: floatBlob 10s ease-in-out infinite;
        }
        .articles-hero::after {
            content: '';
            position: absolute;
            bottom: -20%;
            right: -10%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.15) 0%, transparent 70%);
            animation: floatBlob 8s ease-in-out infinite reverse;
        }
        @keyframes floatBlob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(20px, -20px) scale(1.1); }
            66% { transform: translate(-10px, 10px) scale(0.95); }
        }
        .hero-title {
            background: linear-gradient(135deg, #10b981 0%, #4f46e5 50%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Glass Search */
        .glass-search {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 16px;
            padding: 1.25rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        }
        .search-input {
            border: 2px solid rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        .search-input:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }
        .search-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
        }

        /* Article Cards */
        .article-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            height: 100%;
        }
        .article-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #10b981, #4f46e5);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }
        .article-card:hover::before {
            transform: scaleX(1);
        }
        .article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12);
        }
        .article-card .card-body {
            padding: 1.75rem;
        }
        .article-title {
            font-weight: 700;
            font-size: 1.15rem;
            margin-bottom: 0.75rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .article-excerpt {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 1.25rem;
        }
        .read-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .read-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
            color: white;
        }
        .read-btn i {
            transition: transform 0.3s ease;
        }
        .read-btn:hover i {
            transform: translateX(4px);
        }

        /* Empty State */
        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 20px;
        }
        .empty-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(79, 70, 229, 0.1) 100%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        /* Dark Mode */
        html[data-theme="dark"] .articles-hero {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(79, 70, 229, 0.12) 50%, rgba(245, 158, 11, 0.1) 100%);
        }
        html[data-theme="dark"] .glass-search {
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(255, 255, 255, 0.1);
        }
        html[data-theme="dark"] .search-input {
            background: rgba(15, 23, 42, 0.8);
            border-color: rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
        }
        html[data-theme="dark"] .article-card {
            background: rgba(30, 41, 59, 0.85);
            border-color: rgba(255, 255, 255, 0.1);
        }
        html[data-theme="dark"] .article-title {
            color: #f1f5f9;
        }
        html[data-theme="dark"] .article-excerpt {
            color: #94a3b8;
        }
        html[data-theme="dark"] .empty-state {
            background: rgba(30, 41, 59, 0.5);
        }
    </style>

    <div class="container py-5">
        <!-- Hero Section -->
        <div class="articles-hero reveal text-center">
            <h1 class="display-5 fw-bold hero-title mb-3">{{ __('messages.articles') }}</h1>
            <p class="text-muted lead mb-0">{{ __('messages.articles_subtitle') }}</p>
        </div>

        <!-- Glass Search Bar -->
        <div class="row mb-5 reveal">
            <div class="col-lg-8 mx-auto">
                <div class="glass-search">
                    <form method="GET" action="{{ route('articles.index') }}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control search-input"
                                placeholder="{{ __('messages.search_articles') }}" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary search-btn ms-2">
                                <i class="bi bi-search me-2"></i>{{ __('messages.search') }}
                            </button>
                            @if (request('search'))
                                <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary ms-2" style="border-radius: 12px;">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse($articles as $article)
                <div class="col-lg-6 mb-4 reveal" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                    <div class="card article-card border-0 position-relative">
                        <div class="card-body">
                            <h5 class="article-title">{{ $article->title }}</h5>
                            <p class="article-excerpt">{{ \Illuminate\Support\Str::limit($article->content, 140) }}</p>
                            <a href="{{ route('articles.show', $article->id) }}" class="read-btn text-decoration-none">
                                {{ __('messages.read') }} <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 reveal">
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="bi bi-journal-x" style="font-size: 2.5rem; color: #10b981;"></i>
                        </div>
                        <h4 class="fw-bold mb-2">{{ __('messages.no_articles') }}</h4>
                        <p class="text-muted">Check back later for new content</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
