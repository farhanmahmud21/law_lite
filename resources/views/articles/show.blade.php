@extends('layouts.app')

@section('content')
    <style>
        .article-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .article-header {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(79, 70, 229, 0.08) 50%, rgba(245, 158, 11, 0.06) 100%);
            border-radius: 24px;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .article-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%);
        }
        .article-title {
            background: linear-gradient(135deg, #1e293b 0%, #10b981 50%, #4f46e5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            font-size: 2.25rem;
            line-height: 1.3;
        }
        .article-date {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .article-content {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            line-height: 1.8;
            font-size: 1.1rem;
            color: #374151;
        }
        html[data-theme="dark"] .article-header {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(79, 70, 229, 0.12) 50%, rgba(245, 158, 11, 0.1) 100%);
        }
        html[data-theme="dark"] .article-content {
            background: rgba(30, 41, 59, 0.85);
            border-color: rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
        }
    </style>

    <div class="container py-5">
        <div class="article-container">
            <div class="article-header reveal">
                <h1 class="article-title mb-4">{{ $article->title }}</h1>
                <span class="article-date">
                    <i class="bi bi-calendar3"></i>
                    Published: {{ $article->created_at->format('M d, Y') }}
                </span>
            </div>
            <div class="article-content reveal" style="animation-delay: 0.1s;">
                {!! nl2br(e($article->content)) !!}
            </div>
        </div>
    </div>
@endsection
