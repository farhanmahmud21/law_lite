@extends('layouts.landing')

@section('content')
    <div class="container py-5">
        <div class="row g-4">
            <!-- Left Column: Profile Card -->
            <div class="col-lg-4">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden sticky-top" style="top: 100px; z-index: 1;">
                    <div class="card-body text-center p-5">
                        <div class="position-relative d-inline-block mb-4">
                            @if ($lawyer->user->profile_photo_path)
                                <img src="{{ asset('storage/' . $lawyer->user->profile_photo_path) }}"
                                    alt="{{ $lawyer->user->name }}" class="rounded-circle shadow-sm border border-4 border-white"
                                    style="width: 160px; height: 160px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center shadow-sm border border-4 border-white"
                                    style="width: 160px; height: 160px; font-size: 4rem;">
                                    {{ substr($lawyer->user->name, 0, 1) }}
                                </div>
                            @endif
                            @if ($lawyer->verification_status === 'verified')
                                <div class="position-absolute bottom-0 end-0 translate-middle-x mb-2">
                                    <span class="badge bg-success rounded-pill border border-2 border-white p-2"
                                        title="Verified Lawyer">
                                        <i class="bi bi-check-lg"></i>
                                    </span>
                                </div>
                            @endif
                        </div>

                        <h3 class="fw-bold mb-1">{{ $lawyer->user->name ?? 'Lawyer' }}</h3>
                        <p class="text-primary fw-medium mb-2">{{ $lawyer->expertise ?? __('messages.general_practice') }}</p>
                        <p class="text-muted small mb-4"><i class="bi bi-geo-alt-fill me-1"></i>
                            {{ $lawyer->city ?? __('messages.unknown') }}</p>

                        <div class="d-grid gap-3">
                            @auth
                                <a href="{{ route('messages.inbox') }}" class="btn btn-primary rounded-pill py-2 shadow-sm">
                                    <i class="bi bi-chat-dots-fill me-2"></i>{{ __('messages.message') }}
                                </a>
                                <button class="btn btn-outline-primary rounded-pill py-2" data-bs-toggle="modal"
                                    data-bs-target="#appointmentModal" data-lawyer-id="{{ $lawyer->id }}"
                                    data-hourly-rate="{{ $lawyer->hourly_rate ?? 500 }}"
                                    data-lawyer-name="{{ $lawyer->user->name ?? 'Lawyer' }}">
                                    <i class="bi bi-calendar-check me-2"></i>{{ __('messages.book_appointment') }}
                                </button>
                            @else
                                <a href="{{ route('login') }}"
                                    class="btn btn-primary rounded-pill py-2 shadow-sm">{{ __('messages.sign_in_to_message') }}</a>
                                <a href="{{ route('login') }}"
                                    class="btn btn-outline-primary rounded-pill py-2">{{ __('messages.sign_in_to_book') }}</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Details -->
            <div class="col-lg-8">
                <!-- About Section -->
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body p-4 p-lg-5">
                        <h5 class="fw-bold mb-4 text-primary"><i class="bi bi-person-lines-fill me-2"></i>About</h5>
                        <p class="text-muted leading-relaxed mb-0">{{ $lawyer->bio ?? 'No biography available.' }}</p>
                    </div>
                </div>

                <!-- Education Section -->
                @if (is_array($lawyer->education) && count($lawyer->education) > 0)
                    <div class="card shadow-sm border-0 rounded-4 mb-4">
                        <div class="card-body p-4 p-lg-5">
                            <h5 class="fw-bold mb-4 text-primary"><i class="bi bi-mortarboard-fill me-2"></i>Education</h5>
                            <ul class="list-unstyled mb-0">
                                @foreach ($lawyer->education as $edu)
                                    <li class="d-flex align-items-start mb-3 last-mb-0">
                                        <i class="bi bi-check-circle-fill text-success mt-1 me-3"></i>
                                        <span class="text-muted">{{ $edu }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Experience Section -->
                @if (is_array($lawyer->experience) && count($lawyer->experience) > 0)
                    <div class="card shadow-sm border-0 rounded-4 mb-4">
                        <div class="card-body p-4 p-lg-5">
                            <h5 class="fw-bold mb-4 text-primary"><i class="bi bi-briefcase-fill me-2"></i>Experience</h5>
                            <ul class="list-unstyled mb-0">
                                @foreach ($lawyer->experience as $exp)
                                    <li class="d-flex align-items-start mb-3 last-mb-0">
                                        <i class="bi bi-briefcase text-primary mt-1 me-3"></i>
                                        <span class="text-muted">{{ $exp }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Languages Section -->
                @if (is_array($lawyer->languages) && count($lawyer->languages) > 0)
                    <div class="card shadow-sm border-0 rounded-4 mb-4">
                        <div class="card-body p-4 p-lg-5">
                            <h5 class="fw-bold mb-4 text-primary"><i class="bi bi-translate me-2"></i>Languages</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($lawyer->languages as $lang)
                                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2">{{ $lang }}</span>
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
