<?php
    $user = auth()->user();
    $isLawyer = $user && $user->role === 'lawyer';

    if ($isLawyer) {
        $primaryLinks = [
            ['label' => __('messages.home'), 'route' => route('lawyer.dashboard'), 'active' => request()->routeIs('lawyer.dashboard')],
            ['label' => __('messages.ai_features'), 'route' => route('ai.features'), 'active' => request()->routeIs('ai.features'), 'icon' => 'bi bi-stars me-2 text-accent'],
            ['label' => __('messages.my_articles'), 'route' => route('lawyer.articles.index'), 'active' => request()->routeIs('lawyer.articles.*')],
            ['label' => __('messages.cases'), 'route' => route('lawyer.cases.index'), 'active' => request()->routeIs('lawyer.cases.*')],
            ['label' => __('messages.appointments'), 'route' => route('lawyer.appointments'), 'active' => request()->routeIs('lawyer.appointments')],
            ['label' => __('messages.messages'), 'route' => route('messages.inbox'), 'active' => request()->routeIs('messages.inbox')],
            ['label' => __('messages.notifications'), 'route' => route('notifications.index'), 'active' => request()->routeIs('notifications.*')],
        ];
    } else {
        $primaryLinks = [
            ['label' => __('messages.home'), 'route' => Route::has('home') ? route('home') : url('/'), 'active' => request()->routeIs('home') || request()->is('/')],
            ['label' => __('messages.ai_features'), 'route' => route('ai.features'), 'active' => request()->routeIs('ai.features'), 'icon' => 'bi bi-stars me-2 text-accent'],
            ['label' => __('messages.find_lawyers'), 'route' => route('lawyers.index'), 'active' => request()->routeIs('lawyers.index')],
            ['label' => __('messages.articles'), 'route' => route('articles.index'), 'active' => request()->routeIs('articles.index')],
            ['label' => __('messages.appointments'), 'route' => route('appointments.index'), 'active' => request()->routeIs('appointments.index')],
        ];
    }

    $secondaryLinks = [];
    if ($user && $user->role === 'admin') {
        $secondaryLinks[] = ['label' => __('messages.admin_panel'), 'route' => route('admin.dashboard'), 'active' => request()->routeIs('admin.dashboard')];
    } elseif ($user && !$isLawyer) {
        $secondaryLinks[] = ['label' => __('messages.cases'), 'route' => route('user.cases.index'), 'active' => request()->routeIs('user.cases.index')];
        $secondaryLinks[] = ['label' => __('messages.invoices'), 'route' => route('client.invoices.index'), 'active' => request()->routeIs('client.invoices.*')];
        $secondaryLinks[] = ['label' => __('messages.messages'), 'route' => route('messages.inbox'), 'active' => request()->routeIs('messages.inbox')];
    }
?>

<nav class="site-header navbar navbar-expand-lg navbar-light fixed-top py-3 transition-all">
    <div class="container">
        <a class="logo text-decoration-none d-flex align-items-center gap-3 me-5" href="<?php echo e(url('/')); ?>">
            <div class="logo-icon-wrapper">
                <div class="logo-icon-inner">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Scales of Justice -->
                        <path d="M12 3V21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M5 7L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M3 13L7 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M17 13L21 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <circle cx="5" cy="13" r="3" stroke="currentColor" stroke-width="1.5" fill="none"/>
                        <circle cx="19" cy="13" r="3" stroke="currentColor" stroke-width="1.5" fill="none"/>
                        <path d="M9 21H15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
            <span class="logo-text font-display">
                <span class="law">Law</span><span class="lite">Lite</span>
            </span>
        </a>

        <button class="navbar-toggler border-0 shadow-none p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navSidebar" aria-controls="navSidebar">
            <div class="hamburger-icon">
                <i class="bi bi-list fs-1 text-primary"></i>
            </div>
        </button>

        <div class="d-none d-lg-flex flex-grow-1 align-items-center justify-content-between" id="mainNav">
            <ul class="navbar-nav align-items-lg-center gap-1 gap-lg-4 my-3 my-lg-0">
                <?php $__currentLoopData = $primaryLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e($link['active'] ? 'active' : ''); ?>" href="<?php echo e($link['route']); ?>">
                            <?php if(!empty($link['icon'])): ?>
                                <i class="<?php echo e($link['icon']); ?>"></i>
                            <?php endif; ?>
                            <?php echo e($link['label']); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = $secondaryLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e($link['active'] ? 'active' : ''); ?>" href="<?php echo e($link['route']); ?>">
                            <?php echo e($link['label']); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <div class="d-flex align-items-center gap-3">
                <?php if(auth()->guard()->guest()): ?>
                    <a class="btn btn-outline-primary btn-magnetic rounded-pill px-4 fw-semibold" href="<?php echo e(route('login')); ?>">
                        <?php echo e(__('messages.login')); ?>

                    </a>
                    <a class="btn btn-primary btn-magnetic rounded-pill px-4 fw-semibold shadow-lg" href="<?php echo e(route('register')); ?>">
                        <?php echo e(__('messages.register')); ?>

                    </a>
                <?php else: ?>
                    <div class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar-circle bg-gradient-primary text-white d-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width: 35px; height: 35px; font-size: 0.9rem;">
                                <?php echo e(substr($user->name, 0, 1)); ?>

                            </div>
                            <span class="d-none d-lg-block fw-semibold"><?php echo e($user->name); ?></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end border-0 shadow-2xl mt-3 rounded-4 overflow-hidden p-2 animate__animated animate__fadeIn" style="min-width: 200px;">
                            <div class="px-3 py-2 border-bottom border-light mb-2">
                                <p class="mb-0 fw-bold text-dark"><?php echo e($user->name); ?></p>
                                <small class="text-muted"><?php echo e($user->email); ?></small>
                            </div>
                            
                            <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2" href="<?php echo e(route('profile.show')); ?>">
                                <i class="bi bi-person-gear text-primary"></i> <?php echo e(__('messages.profile')); ?>

                            </a>
                            
                            <?php if($user && $user->role !== 'lawyer'): ?>
                                <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2" href="<?php echo e(route('notifications.index')); ?>">
                                    <i class="bi bi-bell text-warning"></i> <?php echo e(__('messages.notifications')); ?>

                                </a>
                            <?php endif; ?>
                            
                            <div class="dropdown-divider my-2"></div>
                            
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 text-danger">
                                    <i class="bi bi-box-arrow-right"></i> <?php echo e(__('messages.logout')); ?>

                                </button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="d-flex align-items-center gap-2 border-start ps-3 border-secondary border-opacity-10">
                    <!-- Language Switcher -->
                    <div class="dropdown">
                        <button class="btn btn-link nav-utility-btn text-decoration-none p-0 d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-globe"></i>
                            <span class="text-uppercase fw-semibold"><?php echo e(strtoupper(app()->getLocale())); ?></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 p-1" style="min-width: 120px;">
                            <li><a class="dropdown-item rounded-2 <?php echo e(app()->getLocale() == 'en' ? 'active' : ''); ?>" href="<?php echo e(route('lang.switch', 'en')); ?>">🇺🇸 English</a></li>
                            <li><a class="dropdown-item rounded-2 <?php echo e(app()->getLocale() == 'bn' ? 'active' : ''); ?>" href="<?php echo e(route('lang.switch', 'bn')); ?>">🇧🇩 বাংলা</a></li>
                        </ul>
                    </div>

                    <!-- Theme Toggle -->
                    <button class="btn btn-link btn-icon-compact text-muted transition-transform hover-rotate" id="themeToggle" title="Toggle Theme">
                        <i class="bi bi-moon-fill fs-6" id="themeIcon"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-start premium-sidebar text-white" tabindex="-1" id="navSidebar" aria-labelledby="navSidebarLabel">
    <div class="offcanvas-header">
        <div class="d-flex align-items-center gap-2">
            <div class="logo-icon small">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                    <path d="M2 17l10 5 10-5"/>
                    <path d="M2 12l10 5 10-5"/>
                </svg>
            </div>
            <div>
                <span class="logo-text text-white">LawLite</span>
                <p class="sidebar-label text-uppercase small text-muted mb-0">Menu</p>
            </div>
        </div>
        <button type="button" class="btn btn-outline-light btn-icon-compact" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-between">
        <div>
            <p class="sidebar-label text-uppercase small fw-semibold text-muted mb-2">Navigation</p>
            <ul class="list-unstyled sidebar-menu mb-4">
                <?php $__currentLoopData = $primaryLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a class="sidebar-link <?php echo e($link['active'] ? 'active' : ''); ?>" href="<?php echo e($link['route']); ?>" data-bs-dismiss="offcanvas">
                            <span>
                                <?php if(!empty($link['icon'])): ?>
                                    <i class="<?php echo e($link['icon']); ?>"></i>
                                <?php endif; ?>
                                <?php echo e(strtoupper($link['label'])); ?>

                            </span>
                            <i class="bi bi-arrow-up-right"></i>
                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <?php if(!empty($secondaryLinks)): ?>
                <p class="sidebar-label text-uppercase small fw-semibold text-muted mb-2">Dashboard</p>
                <ul class="list-unstyled sidebar-menu mb-4">
                    <?php $__currentLoopData = $secondaryLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a class="sidebar-link <?php echo e($link['active'] ? 'active' : ''); ?>" href="<?php echo e($link['route']); ?>" data-bs-dismiss="offcanvas">
                                <span><?php echo e(strtoupper($link['label'])); ?></span>
                                <i class="bi bi-arrow-up-right"></i>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
        </div>

        <div>
            <?php if(auth()->guard()->guest()): ?>
                <div class="d-grid gap-2 mb-4">
                    <a class="btn btn-outline-primary rounded-pill" href="<?php echo e(route('login')); ?>" data-bs-dismiss="offcanvas"><?php echo e(__('messages.login')); ?></a>
                    <a class="btn btn-primary rounded-pill" href="<?php echo e(route('register')); ?>" data-bs-dismiss="offcanvas"><?php echo e(__('messages.register')); ?></a>
                </div>
            <?php else: ?>
                <div class="sidebar-user border rounded-4 p-3 mb-4">
                    <p class="mb-1 text-uppercase small text-muted"><?php echo e(__('messages.profile')); ?></p>
                    <h6 class="mb-1"><?php echo e($user->name); ?></h6>
                    <small class="text-muted d-block mb-3"><?php echo e($user->email); ?></small>
                    <div class="d-flex gap-2">
                        <a class="btn btn-outline-light btn-sm flex-grow-1" href="<?php echo e(route('profile.show')); ?>" data-bs-dismiss="offcanvas"><?php echo e(__('messages.profile')); ?></a>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="m-0 flex-grow-1">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger btn-sm w-100"><?php echo e(__('messages.logout')); ?></button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>

            <div class="sidebar-contact">
                <p class="sidebar-label text-uppercase small fw-semibold text-muted mb-1">Email</p>
                <a href="mailto:support@lawlite.com" class="d-block mb-3 text-white text-decoration-none">support@lawlite.com</a>
                <p class="sidebar-label text-uppercase small fw-semibold text-muted mb-1">Phone</p>
                <a href="tel:+8801700000000" class="d-block text-white text-decoration-none mb-3">+880 1700-000000</a>
                <div class="d-flex flex-wrap gap-3 text-uppercase small text-muted">
                    <a href="#" class="sidebar-link-minor">Twitter</a>
                    <a href="#" class="sidebar-link-minor">LinkedIn</a>
                    <a href="#" class="sidebar-link-minor">Behance</a>
                    <a href="#" class="sidebar-link-minor">Dribbble</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH G:\CG\LawLite\resources\views/components/navbar.blade.php ENDPATH**/ ?>