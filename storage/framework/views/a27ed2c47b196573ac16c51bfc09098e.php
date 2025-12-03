<?php $__env->startSection('content'); ?>
    <div class="container py-6">
        <div class="row">
            <div class="col-md-4 text-center">
                <?php if($lawyer->user->profile_photo_path): ?>
                    <img src="<?php echo e(asset('storage/' . $lawyer->user->profile_photo_path)); ?>" alt="<?php echo e($lawyer->user->name); ?>"
                        class="rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                <?php else: ?>
                    <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center text-white mb-3"
                        style="width: 200px; height: 200px; font-size: 4rem;">
                        <?php echo e(substr($lawyer->user->name, 0, 1)); ?>

                    </div>
                <?php endif; ?>

                <h3>
                    <?php echo e($lawyer->user->name ?? 'Lawyer'); ?>

                    <?php if($lawyer->verification_status === 'verified'): ?>
                        <span class="badge bg-success rounded-pill fs-6 align-middle" title="Verified Lawyer">
                            <i class="bi bi-check-circle-fill"></i> Verified
                        </span>
                    <?php endif; ?>
                </h3>
                <p class="text-muted"><?php echo e($lawyer->expertise ?? __('messages.general_practice')); ?></p>
                <p><i class="bi bi-geo-alt-fill"></i> <?php echo e($lawyer->city ?? __('messages.unknown')); ?></p>

                <div class="d-grid gap-2">
                    <?php if(auth()->guard()->check()): ?>
                        <button class="btn btn-primary"
                            onclick="openChatWith(<?php echo e($lawyer->user_id ?? 0); ?>)"><?php echo e(__('messages.message')); ?></button>
                        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#appointmentModal"
                            data-lawyer-id="<?php echo e($lawyer->id); ?>" data-hourly-rate="<?php echo e($lawyer->hourly_rate ?? 500); ?>"
                            data-lawyer-name="<?php echo e($lawyer->user->name ?? 'Lawyer'); ?>"><?php echo e(__('messages.book_appointment')); ?></button>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-primary"><?php echo e(__('messages.sign_in_to_message')); ?></a>
                        <a href="<?php echo e(route('login')); ?>"
                            class="btn btn-outline-secondary"><?php echo e(__('messages.sign_in_to_book')); ?></a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">About</h5>
                        <p class="card-text"><?php echo e($lawyer->bio ?? 'No biography available.'); ?></p>
                    </div>
                </div>

                <?php if(is_array($lawyer->education) && count($lawyer->education) > 0): ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Education</h5>
                            <ul class="list-group list-group-flush">
                                <?php $__currentLoopData = $lawyer->education; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item"><?php echo e($edu); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(is_array($lawyer->experience) && count($lawyer->experience) > 0): ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Experience</h5>
                            <ul class="list-group list-group-flush">
                                <?php $__currentLoopData = $lawyer->experience; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item"><?php echo e($exp); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(is_array($lawyer->languages) && count($lawyer->languages) > 0): ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Languages</h5>
                            <p class="card-text"><?php echo e(implode(', ', $lawyer->languages)); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH G:\CG\LawLite\resources\views/lawyers/show.blade.php ENDPATH**/ ?>