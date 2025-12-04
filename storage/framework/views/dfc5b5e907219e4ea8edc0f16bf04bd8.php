<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <h2 class="mb-4 fw-bold"><?php echo e(__('messages.my_invoices')); ?></h2>

        <?php if($invoices->isEmpty()): ?>
            <div class="alert alert-info shadow-sm border-0"><?php echo e(__('messages.no_invoices') ?? 'You have no invoices.'); ?></div>
        <?php else: ?>
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 ps-4">Invoice #</th>
                                    <th class="py-3">Lawyer</th>
                                    <th class="py-3">Amount</th>
                                    <th class="py-3">Date</th>
                                    <th class="py-3">Status</th>
                                    <th class="py-3 pe-4 text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="ps-4 fw-semibold">#<?php echo e($invoice->invoice_number); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                    <?php echo e(substr($invoice->lawyer->user->name ?? 'U', 0, 1)); ?>

                                                </div>
                                                <?php echo e($invoice->lawyer->user->name ?? 'Unknown'); ?>

                                            </div>
                                        </td>
                                        <td class="fw-bold">$<?php echo e(number_format($invoice->amount, 2)); ?></td>
                                        <td class="text-muted"><?php echo e($invoice->created_at->format('M d, Y')); ?></td>
                                        <td>
                                            <?php if($invoice->status === 'paid'): ?>
                                                <span class="badge bg-success-subtle text-success rounded-pill px-3">Paid</span>
                                            <?php elseif($invoice->status === 'cancelled'): ?>
                                                <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3">Cancelled</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3">Unpaid</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <a href="<?php echo e(route('client.invoices.show', $invoice->id)); ?>"
                                                class="btn btn-sm btn-outline-primary rounded-pill px-3">View</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH G:\CG\LawLite\resources\views/client/invoices/index.blade.php ENDPATH**/ ?>