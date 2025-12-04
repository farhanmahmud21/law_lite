<?php $__env->startSection('content'); ?>
    <style>
        .marquee-container {
            display: flex;
            overflow: hidden;
            width: 100%;
            mask-image: linear-gradient(to right, transparent, black 5%, black 95%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 5%, black 95%, transparent);
        }

        .marquee-content {
            white-space: nowrap;
            padding-right: 2rem;
            flex-shrink: 0;
            animation: marquee 15s linear infinite;
        }

        @keyframes marquee {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-100%);
            }
        }

        /* Pause on hover */
        .marquee-container:hover .marquee-content {
            animation-play-state: paused;
        }

        /* Premium Page Header */
        .page-header-premium {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.08) 0%, rgba(16, 185, 129, 0.08) 50%, rgba(245, 158, 11, 0.08) 100%);
            border-radius: 24px;
            padding: 3rem 2rem;
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .page-header-premium::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.15) 0%, transparent 70%);
            animation: floatOrb 8s ease-in-out infinite;
        }
        @keyframes floatOrb {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-30px, 20px) scale(1.1); }
        }

        /* Glass Search Bar */
        .glass-search-container {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        .glass-search-container:focus-within {
            box-shadow: 0 12px 40px rgba(79, 70, 229, 0.15);
            border-color: rgba(79, 70, 229, 0.3);
        }
        .search-input-premium {
            border: 2px solid rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            padding: 0.875rem 1.25rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }
        .search-input-premium:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }
        .search-btn-premium {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border: none;
            border-radius: 12px;
            padding: 0.875rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .search-btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.35);
        }

        /* Premium Lawyer Cards */
        .lawyer-card-premium {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
        }
        .lawyer-card-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4f46e5, #10b981, #f59e0b);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .lawyer-card-premium:hover::before {
            opacity: 1;
        }
        .lawyer-card-premium:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
            border-color: rgba(79, 70, 229, 0.2);
        }
        .lawyer-avatar {
            position: relative;
            display: inline-block;
        }
        .lawyer-avatar img,
        .lawyer-avatar .avatar-placeholder {
            border: 3px solid rgba(79, 70, 229, 0.2);
            transition: all 0.3s ease;
        }
        .lawyer-card-premium:hover .lawyer-avatar img,
        .lawyer-card-premium:hover .lawyer-avatar .avatar-placeholder {
            border-color: #4f46e5;
            transform: scale(1.05);
        }
        .expertise-badge {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
            color: #4f46e5;
            padding: 0.35rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }
        .view-profile-btn {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border: none;
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .view-profile-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }
        .view-profile-btn:hover::before {
            left: 100%;
        }
        .view-profile-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4);
            color: white;
        }

        /* Suggestions Dropdown Premium */
        .suggestions-dropdown {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(79, 70, 229, 0.1) !important;
            border-radius: 16px !important;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15) !important;
            overflow: hidden;
        }
        .suggestion-item {
            transition: all 0.2s ease !important;
        }
        .suggestion-item:hover {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.05) 0%, rgba(124, 58, 237, 0.05) 100%) !important;
        }

        /* Dark Mode Enhancements */
        html[data-theme="dark"] .page-header-premium {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.15) 0%, rgba(16, 185, 129, 0.1) 50%, rgba(245, 158, 11, 0.08) 100%);
        }
        html[data-theme="dark"] .glass-search-container {
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(255, 255, 255, 0.1);
        }
        html[data-theme="dark"] .search-input-premium {
            background: rgba(15, 23, 42, 0.8);
            border-color: rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
        }
        html[data-theme="dark"] .lawyer-card-premium {
            background: rgba(30, 41, 59, 0.85);
            border-color: rgba(255, 255, 255, 0.1);
        }
        html[data-theme="dark"] .expertise-badge {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.25) 0%, rgba(124, 58, 237, 0.2) 100%);
        }
        html[data-theme="dark"] .suggestions-dropdown {
            background: rgba(15, 23, 42, 0.95) !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
        }

        /* Empty State */
        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
        }
        .empty-state-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }
    </style>

    <div class="container py-5">
        <!-- Premium Header -->
        <div class="page-header-premium reveal text-center">
            <h1 class="display-5 fw-bold mb-3" style="background: linear-gradient(135deg, #1e293b 0%, #4f46e5 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                <?php echo e(__('messages.find_lawyers')); ?>

            </h1>
            <p class="text-muted lead mb-0"><?php echo e(__('messages.find_lawyers_description')); ?></p>
        </div>

        <!-- Glass Search Bar -->
        <div class="row mb-5 reveal">
            <div class="col-lg-8 mx-auto">
                <div class="glass-search-container">
                    <form method="GET" action="<?php echo e(route('lawyers.index')); ?>" id="lawyer-search-form">
                        <div class="input-group position-relative">
                            <input type="text" name="search" id="lawyer-search-input" 
                                class="form-control search-input-premium"
                                placeholder="<?php echo e(__('messages.search_lawyers_placeholder')); ?>" 
                                value="<?php echo e(request('search')); ?>"
                                autocomplete="off">
                            <button type="submit" class="btn btn-primary search-btn-premium ms-2">
                                <i class="bi bi-search me-2"></i><?php echo e(__('messages.search')); ?>

                            </button>
                            <?php if(request('search')): ?>
                                <a href="<?php echo e(route('lawyers.index')); ?>" class="btn btn-outline-secondary ms-2" style="border-radius: 12px;">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            <?php endif; ?>

                            <!-- Suggestions Dropdown -->
                            <div id="suggestions-dropdown" class="position-absolute border rounded shadow-sm w-100 suggestions-dropdown"
                                style="top: 100%; left: 0; z-index: 1000; display: none; max-height: 300px; overflow-y: auto; margin-top: 8px;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $lawyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lawyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-lg-4 col-md-6 mb-4 reveal" style="animation-delay: <?php echo e($loop->index * 0.1); ?>s;">
                    <div class="card h-100 lawyer-card-premium border-0">
                        <div class="card-body text-center p-4">
                            <div class="lawyer-avatar mb-3">
                                <?php if($lawyer->user && $lawyer->user->profile_photo_path): ?>
                                    <img src="<?php echo e(asset('storage/' . $lawyer->user->profile_photo_path)); ?>"
                                        alt="<?php echo e($lawyer->user->name); ?>" class="rounded-circle object-fit-cover shadow"
                                        style="width: 100px; height: 100px;">
                                <?php else: ?>
                                    <div class="rounded-circle bg-gradient-primary d-inline-flex align-items-center justify-content-center text-white avatar-placeholder shadow"
                                        style="width: 100px; height: 100px; font-size: 2.5rem; background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
                                        <?php echo e(substr($lawyer->user->name ?? 'L', 0, 1)); ?>

                                    </div>
                                <?php endif; ?>
                            </div>

                            <h5 class="card-title fw-bold mb-2"><?php echo e($lawyer->user->name ?? __('messages.unnamed_lawyer')); ?></h5>
                            <div class="expertise-badge mb-3">
                                <?php echo e($lawyer->expertise ?? __('messages.general_practice')); ?>

                            </div>

                            <?php if(is_array($lawyer->education) && count($lawyer->education) > 0): ?>
                                <?php $eduText = $lawyer->education[0]; ?>
                                <?php if(strlen($eduText) > 25): ?>
                                    <div class="marquee-container mb-2" title="<?php echo e($eduText); ?>">
                                        <div class="marquee-content small text-muted">
                                            <i class="bi bi-mortarboard-fill me-1 text-primary"></i> <?php echo e($eduText); ?>

                                        </div>
                                        <div class="marquee-content small text-muted">
                                            <i class="bi bi-mortarboard-fill me-1 text-primary"></i> <?php echo e($eduText); ?>

                                        </div>
                                    </div>
                                <?php else: ?>
                                    <p class="small text-muted mb-2 text-truncate" title="<?php echo e($eduText); ?>">
                                        <i class="bi bi-mortarboard-fill me-1 text-primary"></i> <?php echo e($eduText); ?>

                                    </p>
                                <?php endif; ?>
                            <?php endif; ?>

                            <p class="small text-muted mb-4">
                                <i class="bi bi-geo-alt-fill me-1 text-danger"></i> <?php echo e($lawyer->city ?? __('messages.unknown')); ?>

                            </p>

                            <a href="<?php echo e(route('lawyers.show', $lawyer->id)); ?>" class="view-profile-btn w-100 d-inline-block text-center text-decoration-none">
                                <i class="bi bi-person-lines-fill me-2"></i><?php echo e(__('messages.view_profile')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="empty-state reveal">
                        <div class="empty-state-icon">
                            <i class="bi bi-person-x" style="font-size: 2.5rem; color: #4f46e5;"></i>
                        </div>
                        <h4 class="fw-bold mb-2"><?php echo e(__('messages.no_lawyers_found')); ?></h4>
                        <p class="text-muted">Try adjusting your search criteria</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('lawyer-search-input');
            const suggestionsDropdown = document.getElementById('suggestions-dropdown');
            let debounceTimer;

            searchInput.addEventListener('input', function() {
                const query = this.value.trim();

                // Clear previous timer
                clearTimeout(debounceTimer);

                // Hide suggestions if query is empty
                if (query.length < 2) {
                    suggestionsDropdown.style.display = 'none';
                    return;
                }

                // Debounce the search (wait 300ms after user stops typing)
                debounceTimer = setTimeout(() => {
                    fetchSuggestions(query);
                }, 300);
            });

            function fetchSuggestions(query) {
                fetch(`<?php echo e(route('lawyers.index')); ?>?search=${encodeURIComponent(query)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        // Parse the HTML to extract lawyer data
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const lawyerCards = doc.querySelectorAll('.card .card-body');

                        if (lawyerCards.length === 0) {
                            suggestionsDropdown.innerHTML =
                                '<div class="p-3 text-muted"><?php echo e(__('messages.no_lawyers_found')); ?></div>';
                            suggestionsDropdown.style.display = 'block';
                            return;
                        }

                        // Build suggestions list
                        let suggestionsHTML = '';
                        lawyerCards.forEach(card => {
                            const name = card.querySelector('.card-title')?.textContent?.trim() || '';
                            const expertise = card.querySelector('.card-text')?.textContent?.trim() ||
                                '';
                            const location = card.querySelector('small')?.textContent?.trim() || '';
                            const profileLink = card.querySelector('a')?.getAttribute('href') || '#';

                            suggestionsHTML += `
                            <a href="${profileLink}" class="d-block p-3 text-decoration-none border-bottom suggestion-item" 
                               style="cursor: pointer;">
                                <div class="fw-bold">${name}</div>
                                <div class="small text-muted">${expertise}</div>
                                <div class="small text-muted">${location}</div>
                            </a>
                        `;
                        });

                        suggestionsDropdown.innerHTML = suggestionsHTML;
                        suggestionsDropdown.style.display = 'block';

                        // Add hover effect - respect dark mode
                        const isDarkMode = document.documentElement.getAttribute('data-theme') === 'dark';
                        document.querySelectorAll('.suggestion-item').forEach(item => {
                            item.addEventListener('mouseenter', function() {
                                this.style.backgroundColor = isDarkMode ? '#1e293b' : '#f8f9fa';
                            });
                            item.addEventListener('mouseleave', function() {
                                this.style.backgroundColor = isDarkMode ? '#0f172a' : 'white';
                            });
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching suggestions:', error);
                    });
            }

            // Close suggestions when clicking outside
            document.addEventListener('click', function(event) {
                if (!searchInput.contains(event.target) && !suggestionsDropdown.contains(event.target)) {
                    suggestionsDropdown.style.display = 'none';
                }
            });

            // Show suggestions again when input is focused and has value
            searchInput.addEventListener('focus', function() {
                if (this.value.trim().length >= 2) {
                    fetchSuggestions(this.value.trim());
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH G:\CG\LawLite\resources\views/lawyers/index.blade.php ENDPATH**/ ?>