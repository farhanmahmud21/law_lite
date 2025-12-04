<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3"><?php echo e(__('messages.dashboard')); ?></h1>
                <p class="text-muted"><?php echo e(__('messages.welcome_back')); ?>, <?php echo e($user->name); ?></p>
            </div>
            <a href="<?php echo e(route('lawyer.cases.create')); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> <?php echo e(__('messages.add_new_case')); ?>

            </a>
            <a href="<?php echo e(route('lawyer.availability.index')); ?>" class="btn btn-outline-primary ms-2">
                <i class="bi bi-calendar-check"></i> <?php echo e(__('messages.manage_availability')); ?>

            </a>
        </div>

        <?php if(session('status')): ?>
            <div class="alert alert-success"><?php echo e(session('status')); ?></div>
        <?php endif; ?>

        <div class="row">
            <!-- Upcoming Cases Section -->
            <div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><?php echo e(__('messages.upcoming_cases')); ?></h5>
                        <a href="<?php echo e(route('lawyer.cases.index')); ?>"
                            class="btn btn-sm btn-outline-primary"><?php echo e(__('messages.view_all')); ?></a>
                    </div>
                    <div class="card-body">
                        <?php if($upcomingCases->isEmpty()): ?>
                            <div class="text-center py-5">
                                <p class="text-muted"><?php echo e(__('messages.no_upcoming_cases')); ?></p>
                                <a href="<?php echo e(route('lawyer.cases.create')); ?>" class="btn btn-sm btn-primary mt-2">
                                    <?php echo e(__('messages.add_first_case')); ?>

                                </a>
                            </div>
                        <?php else: ?>
                            <div class="list-group list-group-flush">
                                <?php $__currentLoopData = $upcomingCases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('lawyer.cases.show', $case->id)); ?>"
                                        class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between align-items-start">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1"><?php echo e($case->title); ?></h6>
                                                <p class="mb-1 text-muted small">
                                                    <strong><?php echo e(__('messages.client')); ?>:</strong> <?php echo e($case->client_name); ?>

                                                    <?php if($case->client_phone): ?>
                                                        <span class="ms-2">📞 <?php echo e($case->client_phone); ?></span>
                                                    <?php endif; ?>
                                                </p>
                                                <?php if($case->description): ?>
                                                    <p class="mb-1 small">
                                                        <?php echo e(\Illuminate\Support\Str::limit($case->description, 100)); ?></p>
                                                <?php endif; ?>
                                                <?php if($case->court_location): ?>
                                                    <p class="mb-0 text-muted small">📍 <?php echo e($case->court_location); ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="text-end ms-3">
                                                <?php if($case->hearing_date): ?>
                                                    <div class="badge bg-info mb-1">
                                                        <?php echo e($case->hearing_date->format('M d, Y')); ?>

                                                    </div>
                                                    <?php if($case->hearing_time): ?>
                                                        <div class="small text-muted">
                                                            <?php echo e(\Carbon\Carbon::parse($case->hearing_time)->format('h:i A')); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <div class="mt-1">
                                                    <?php if($case->status === 'pending'): ?>
                                                        <span class="badge bg-warning"><?php echo e(__('messages.pending')); ?></span>
                                                    <?php elseif($case->status === 'in_progress'): ?>
                                                        <span
                                                            class="badge bg-primary"><?php echo e(__('messages.in_progress')); ?></span>
                                                    <?php elseif($case->status === 'completed'): ?>
                                                        <span
                                                            class="badge bg-success"><?php echo e(__('messages.completed')); ?></span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary"><?php echo e(__('messages.closed')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- AI Assistant Section -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><?php echo e(__('messages.ai_assistant')); ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="small text-muted mb-3"><?php echo e(__('messages.ai_assistant_intro')); ?></p>

                        <form action="<?php echo e(route('ai.ask')); ?>" method="POST" id="aiQuestionForm">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <textarea name="question" class="form-control" rows="4" placeholder="<?php echo e(__('messages.ai_placeholder')); ?>"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <?php echo e(__('messages.ai_submit')); ?>

                            </button>
                        </form>

                        <div id="aiResponse" class="mt-3" style="display:none;">
                            <div class="alert alert-info"></div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <?php if($lawyer): ?>
                    <div class="card mt-3">
                        <div class="card-body">
                            <h6 class="card-title"><?php echo e(__('messages.practice_analytics')); ?></h6>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="border rounded p-2 text-center">
                                        <small class="text-muted d-block"><?php echo e(__('messages.earnings')); ?></small>
                                        <h5 class="mb-0 text-success">$<?php echo e(number_format($totalEarnings, 2)); ?></h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded p-2 text-center">
                                        <small class="text-muted d-block"><?php echo e(__('messages.pending_payment')); ?></small>
                                        <h5 class="mb-0 text-warning">$<?php echo e(number_format($pendingInvoices, 2)); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted"><?php echo e(__('messages.total_cases')); ?></span>
                                <strong><?php echo e($totalCases); ?></strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted"><?php echo e(__('messages.active_cases')); ?></span>
                                <strong><?php echo e($activeCases); ?></strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted"><?php echo e(__('messages.cases_won')); ?></span>
                                <strong class="text-success"><?php echo e($casesWon); ?></strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted"><?php echo e(__('messages.cases_lost')); ?></span>
                                <strong class="text-danger"><?php echo e($casesLost); ?></strong>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted"><?php echo e(__('messages.verification')); ?></span>
                                <?php if($lawyer->verification_status === 'verified'): ?>
                                    <span class="badge bg-success"><?php echo e(__('messages.verified')); ?></span>
                                <?php elseif($lawyer->verification_status === 'requested'): ?>
                                    <span class="badge bg-warning"><?php echo e(__('messages.pending')); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?php echo e(__('messages.not_verified')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="d-grid">
                                <a href="<?php echo e(route('lawyer.invoices.index')); ?>"
                                    class="btn btn-outline-primary btn-sm"><?php echo e(__('messages.manage_invoices')); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.getElementById('aiQuestionForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = e.target;
            const submitBtn = form.querySelector('button[type="submit"]');
            const responseDiv = document.getElementById('aiResponse');
            const responseAlert = responseDiv.querySelector('.alert');

            submitBtn.disabled = true;
            submitBtn.innerHTML =
                '<span class="spinner-border spinner-border-sm me-2"></span><?php echo e(__('messages.processing')); ?>';
            responseDiv.style.display = 'block';
            responseAlert.className = 'alert alert-info';
            responseAlert.textContent = '<?php echo e(__('messages.thinking')); ?>';

            try {
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.ok) {
                    responseAlert.className = 'alert alert-success';
                    const answer = typeof data.result === 'string' ? data.result : JSON.stringify(data.result,
                        null, 2);
                    responseAlert.innerHTML =
                        '<strong><?php echo e(__('messages.answer_label')); ?></strong><br><div style="white-space: pre-wrap;">' +
                        answer + '</div>';
                } else {
                    responseAlert.className = 'alert alert-danger';
                    responseAlert.textContent = data.error || data.message ||
                        '<?php echo e(__('messages.error_occurred')); ?>';
                }
            } catch (error) {
                responseAlert.className = 'alert alert-danger';
                responseAlert.textContent = '<?php echo e(__('messages.network_error')); ?>';
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = '<?php echo e(__('messages.ai_submit')); ?>';
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH G:\CG\LawLite\resources\views/lawyers/dashboard.blade.php ENDPATH**/ ?>