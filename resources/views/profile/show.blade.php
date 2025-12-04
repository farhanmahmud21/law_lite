@extends('layouts.landing')

@section('content')
    <style>
        .profile-header {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.08) 0%, rgba(16, 185, 129, 0.08) 50%, rgba(245, 158, 11, 0.06) 100%);
            border-radius: 24px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        .profile-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.15) 0%, transparent 70%);
        }
        .profile-title {
            background: linear-gradient(135deg, #4f46e5 0%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            overflow: hidden;
        }
        .glass-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.12);
        }
        .glass-header {
            background: rgba(255, 255, 255, 0.5);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.25rem 1.5rem;
        }
        .glass-header h5 {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .profile-photo-wrapper {
            position: relative;
            display: inline-block;
        }
        .profile-photo-wrapper img,
        .profile-photo-wrapper .avatar-placeholder {
            border: 4px solid rgba(79, 70, 229, 0.2);
            transition: all 0.3s ease;
        }
        .profile-photo-wrapper:hover img,
        .profile-photo-wrapper:hover .avatar-placeholder {
            border-color: #4f46e5;
            transform: scale(1.02);
        }
        .avatar-placeholder {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%) !important;
        }
        .role-badge {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.15) 0%, rgba(124, 58, 237, 0.15) 100%);
            color: #4f46e5;
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .premium-input {
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        .premium-input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            background: white;
        }
        .premium-select {
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        .premium-select:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }
        .input-icon {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
            border: none;
            border-radius: 12px 0 0 12px;
            color: #4f46e5;
        }
        .save-btn {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border: none;
            border-radius: 12px;
            padding: 0.875rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .save-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4);
        }
        .security-card .glass-header {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.05) 0%, rgba(249, 115, 22, 0.05) 100%);
        }
        .security-card .glass-header h5 {
            background: linear-gradient(135deg, #ef4444 0%, #f97316 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .password-btn {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .password-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(100, 116, 139, 0.35);
        }
        .camera-btn {
            background: white;
            border: 2px solid rgba(79, 70, 229, 0.2);
            border-radius: 50%;
            padding: 0.5rem;
            transition: all 0.3s ease;
        }
        .camera-btn:hover {
            background: #4f46e5;
            border-color: #4f46e5;
        }
        .camera-btn:hover i {
            color: white !important;
        }
        html[data-theme="dark"] .profile-header {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.15) 0%, rgba(16, 185, 129, 0.12) 50%, rgba(245, 158, 11, 0.1) 100%);
        }
        html[data-theme="dark"] .glass-card {
            background: rgba(30, 41, 59, 0.85);
            border-color: rgba(255, 255, 255, 0.1);
        }
        html[data-theme="dark"] .glass-header {
            background: rgba(255, 255, 255, 0.05);
        }
        html[data-theme="dark"] .premium-input,
        html[data-theme="dark"] .premium-select {
            background: rgba(15, 23, 42, 0.8);
            border-color: rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
        }
        html[data-theme="dark"] .input-icon {
            background: rgba(79, 70, 229, 0.2);
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="profile-header reveal">
                    <h2 class="fw-bold profile-title mb-0">{{ __('messages.profile') }}</h2>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm reveal" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <!-- Left Column: Personal Info -->
                        <div class="col-md-4">
                            <div class="glass-card h-100 reveal">
                                <div class="card-body text-center p-4">
                                    <div class="profile-photo-wrapper mb-3">
                                        @if ($user->profile_photo_path)
                                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                                alt="Profile Photo" class="rounded-circle shadow object-fit-cover"
                                                style="width: 120px; height: 120px;">
                                        @else
                                            <div class="rounded-circle avatar-placeholder text-white d-flex align-items-center justify-content-center shadow mx-auto"
                                                style="width: 120px; height: 120px; font-size: 3rem;">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <label for="profile_photo"
                                            class="position-absolute bottom-0 end-0 camera-btn shadow"
                                            style="cursor: pointer;" title="Change Photo">
                                            <i class="bi bi-camera-fill text-primary"></i>
                                            <input type="file" id="profile_photo" name="profile_photo" class="d-none"
                                                accept="image/*" onchange="this.form.submit()">
                                        </label>
                                    </div>
                                    <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                                    <p class="text-muted mb-3">{{ $user->email }}</p>
                                    <span class="role-badge">{{ $user->role }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Edit Details -->
                        <div class="col-md-8">
                            <div class="glass-card mb-4 reveal" style="animation-delay: 0.1s;">
                                <div class="glass-header">
                                    <h5 class="mb-0 fw-bold"><i class="bi bi-person-lines-fill me-2"></i>Personal Information</h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small">{{ __('messages.name') }}</label>
                                            <input type="text" name="name" class="form-control premium-input"
                                                value="{{ old('name', $user->name) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small">{{ __('messages.email') }}</label>
                                            <input type="email" name="email" class="form-control premium-input"
                                                value="{{ old('email', $user->email) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small">{{ __('messages.language') }}</label>
                                            <select name="language_preference" class="form-select premium-select">
                                                <option value="en"
                                                    {{ $user->language_preference == 'en' ? 'selected' : '' }}>
                                                    English</option>
                                                <option value="bn"
                                                    {{ $user->language_preference == 'bn' ? 'selected' : '' }}>
                                                    Bengali</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($user->role === 'lawyer')
                                <div class="glass-card mb-4 reveal" style="animation-delay: 0.2s;">
                                    <div class="glass-header">
                                        <h5 class="mb-0 fw-bold"><i class="bi bi-briefcase-fill me-2"></i>Professional Profile</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold small">Bio</label>
                                            <textarea name="bio" class="form-control premium-input" rows="4" placeholder="Tell clients about yourself...">{{ old('bio', $user->lawyer->bio ?? '') }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold small">Education / University</label>
                                            <textarea name="education" class="form-control premium-input" rows="3" placeholder="Enter each degree/university on a new line">{{ old('education', implode("\n", $user->lawyer->education ?? [])) }}</textarea>
                                            <div class="form-text">List your degrees and universities (one per line).</div>
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold small">Expertise</label>
                                                <div class="input-group">
                                                    <span class="input-group-text input-icon"><i class="bi bi-award"></i></span>
                                                    <input type="text" name="expertise" class="form-control premium-input" style="border-radius: 0 12px 12px 0;"
                                                        value="{{ old('expertise', $user->lawyer->expertise ?? '') }}"
                                                        placeholder="e.g. Criminal Law">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold small">Hourly Rate (BDT)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text input-icon">৳</span>
                                                    <input type="number" name="hourly_rate" class="form-control premium-input" style="border-radius: 0 12px 12px 0;"
                                                        value="{{ old('hourly_rate', $user->lawyer->hourly_rate ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold small">City</label>
                                                <div class="input-group">
                                                    <span class="input-group-text input-icon"><i class="bi bi-geo-alt"></i></span>
                                                    <input type="text" name="city" class="form-control premium-input" style="border-radius: 0 12px 12px 0;"
                                                        value="{{ old('city', $user->lawyer->city ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold small">License Number</label>
                                                <div class="input-group">
                                                    <span class="input-group-text input-icon"><i class="bi bi-card-heading"></i></span>
                                                    <input type="text" name="license_number" class="form-control premium-input" style="border-radius: 0 12px 12px 0;"
                                                        value="{{ old('license_number', $user->lawyer->license_number ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="d-flex justify-content-end mb-4">
                                <button type="submit" class="btn btn-primary save-btn">
                                    <i class="bi bi-save me-2"></i>Save Changes
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Security Section -->
                <div class="row justify-content-end">
                    <div class="col-md-8">
                        <div class="glass-card security-card reveal" style="animation-delay: 0.3s;">
                            <div class="glass-header">
                                <h5 class="mb-0 fw-bold"><i class="bi bi-shield-lock-fill me-2"></i>Security</h5>
                            </div>
                            <div class="card-body p-4">
                                <form method="POST" action="{{ route('profile.password.update') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3 align-items-end">
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold small">Current Password</label>
                                            <input type="password" name="current_password" class="form-control premium-input" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold small">New Password</label>
                                            <input type="password" name="password" class="form-control premium-input" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold small">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control premium-input" required>
                                        </div>
                                    </div>
                                    @error('current_password')
                                        <div class="text-danger mt-2 small">{{ $message }}</div>
                                    @enderror
                                    @error('password')
                                        <div class="text-danger mt-2 small">{{ $message }}</div>
                                    @enderror

                                    <div class="mt-3 text-end">
                                        <button type="submit" class="btn btn-secondary password-btn px-4">
                                            <i class="bi bi-key me-2"></i>Update Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
