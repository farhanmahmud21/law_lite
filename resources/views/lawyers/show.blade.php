@extends('layouts.landing')

@section('content')
    <style>
        .profile-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.12);
            overflow: hidden;
            position: relative;
        }
        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 120px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #10b981 100%);
        }
        .profile-photo {
            position: relative;
            z-index: 1;
            margin-top: 60px;
        }
        .profile-photo img,
        .profile-photo .avatar-placeholder {
            border: 5px solid white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }
        .profile-photo:hover img,
        .profile-photo:hover .avatar-placeholder {
            transform: scale(1.05);
        }
        .avatar-placeholder {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%) !important;
        }
        .verified-badge {
            background: linear-gradient(135deg, #10b981, #059669);
            border: 3px solid white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        .expertise-badge {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
            color: #4f46e5;
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-weight: 600;
        }
        .action-btn-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border: none;
            border-radius: 50px;
            padding: 0.875rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .action-btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }
        .action-btn-primary:hover::before {
            left: 100%;
        }
        .action-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(79, 70, 229, 0.4);
        }
        .action-btn-outline {
            background: transparent;
            border: 2px solid rgba(79, 70, 229, 0.3);
            color: #4f46e5;
            border-radius: 50px;
            padding: 0.8rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .action-btn-outline:hover {
            background: rgba(79, 70, 229, 0.1);
            border-color: #4f46e5;
            color: #4f46e5;
            transform: translateY(-3px);
        }
        .detail-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            overflow: hidden;
            position: relative;
        }
        .detail-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4f46e5, #7c3aed, #10b981);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .detail-card:hover::before {
            opacity: 1;
        }
        .detail-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.12);
        }
        .section-title {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .education-item,
        .experience-item {
            background: rgba(79, 70, 229, 0.05);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-bottom: 0.75rem;
            transition: all 0.3s ease;
        }
        .education-item:hover,
        .experience-item:hover {
            background: rgba(79, 70, 229, 0.1);
            transform: translateX(4px);
        }
        .language-badge {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        .language-badge:hover {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);
            transform: scale(1.05);
        }
        html[data-theme="dark"] .profile-card,
        html[data-theme="dark"] .detail-card {
            background: rgba(30, 41, 59, 0.85);
            border-color: rgba(255, 255, 255, 0.1);
        }
        html[data-theme="dark"] .education-item,
        html[data-theme="dark"] .experience-item {
            background: rgba(79, 70, 229, 0.15);
        }
    </style>

    <div class="container py-5">
        <div class="row g-4">
            <!-- Left Column: Profile Card -->
            <div class="col-lg-4">
                <div class="profile-card sticky-top reveal" style="top: 100px; z-index: 1;">
                    <div class="card-body text-center p-5">
                        <div class="profile-photo d-inline-block mb-4">
                            @if ($lawyer->user->profile_photo_path)
                                <img src="{{ asset('storage/' . $lawyer->user->profile_photo_path) }}"
                                    alt="{{ $lawyer->user->name }}" class="rounded-circle"
                                    style="width: 160px; height: 160px; object-fit: cover;">
                            @else
                                <div class="rounded-circle avatar-placeholder text-white d-inline-flex align-items-center justify-content-center"
                                    style="width: 160px; height: 160px; font-size: 4rem;">
                                    {{ substr($lawyer->user->name, 0, 1) }}
                                </div>
                            @endif
                            @if ($lawyer->verification_status === 'verified')
                                <div class="position-absolute bottom-0 end-0 translate-middle-x mb-2">
                                    <span class="badge verified-badge rounded-pill p-2" title="Verified Lawyer">
                                        <i class="bi bi-check-lg text-white"></i>
                                    </span>
                                </div>
                            @endif
                        </div>

                        <h3 class="fw-bold mb-2">{{ $lawyer->user->name ?? 'Lawyer' }}</h3>
                        <div class="expertise-badge mb-3">{{ $lawyer->expertise ?? __('messages.general_practice') }}</div>
                        <p class="text-muted small mb-4">
                            <i class="bi bi-geo-alt-fill me-1 text-danger"></i>{{ $lawyer->city ?? __('messages.unknown') }}
                        </p>

                        <div class="d-grid gap-3">
                            @auth
                                <a href="{{ route('messages.inbox') }}" class="btn btn-primary action-btn-primary">
                                    <i class="bi bi-chat-dots-fill me-2"></i>{{ __('messages.message') }}
                                </a>
                                <button class="btn action-btn-outline" data-bs-toggle="modal"
                                    data-bs-target="#appointmentModal" data-lawyer-id="{{ $lawyer->id }}"
                                    data-hourly-rate="{{ $lawyer->hourly_rate ?? 500 }}"
                                    data-lawyer-name="{{ $lawyer->user->name ?? 'Lawyer' }}">
                                    <i class="bi bi-calendar-check me-2"></i>{{ __('messages.book_appointment') }}
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary action-btn-primary">
                                    {{ __('messages.sign_in_to_message') }}
                                </a>
                                <a href="{{ route('login') }}" class="btn action-btn-outline">
                                    {{ __('messages.sign_in_to_book') }}
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Details -->
            <div class="col-lg-8">
                <!-- About Section -->
                <div class="detail-card mb-4 reveal">
                    <div class="card-body p-4 p-lg-5">
                        <h5 class="fw-bold mb-4 section-title"><i class="bi bi-person-lines-fill me-2"></i>About</h5>
                        <p class="text-muted leading-relaxed mb-0">{{ $lawyer->bio ?? 'No biography available.' }}</p>
                    </div>
                </div>

                <!-- Education Section -->
                @if (is_array($lawyer->education) && count($lawyer->education) > 0)
                    <div class="detail-card mb-4 reveal" style="animation-delay: 0.1s;">
                        <div class="card-body p-4 p-lg-5">
                            <h5 class="fw-bold mb-4 section-title"><i class="bi bi-mortarboard-fill me-2"></i>Education</h5>
                            @foreach ($lawyer->education as $edu)
                                <div class="education-item d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill text-success me-3"></i>
                                    <span>{{ $edu }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Experience Section -->
                @if (is_array($lawyer->experience) && count($lawyer->experience) > 0)
                    <div class="detail-card mb-4 reveal" style="animation-delay: 0.2s;">
                        <div class="card-body p-4 p-lg-5">
                            <h5 class="fw-bold mb-4 section-title"><i class="bi bi-briefcase-fill me-2"></i>Experience</h5>
                            @foreach ($lawyer->experience as $exp)
                                <div class="experience-item d-flex align-items-center">
                                    <i class="bi bi-briefcase text-primary me-3"></i>
                                    <span>{{ $exp }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Languages Section -->
                @if (is_array($lawyer->languages) && count($lawyer->languages) > 0)
                    <div class="detail-card mb-4 reveal" style="animation-delay: 0.3s;">
                        <div class="card-body p-4 p-lg-5">
                            <h5 class="fw-bold mb-4 section-title"><i class="bi bi-translate me-2"></i>Languages</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($lawyer->languages as $lang)
                                    <span class="language-badge">{{ $lang }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('components.appointment_modal')
@endsection
