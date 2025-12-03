@extends('layouts.landing')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 overflow-hidden rounded-4">
                    <div class="card-body p-5">
                        @if (session('success'))
                            <div class="alert alert-success mb-4 rounded-3 shadow-sm border-0">{{ session('success') }}</div>
                        @endif

                        <div class="d-flex justify-content-between align-items-start mb-5">
                            <div>
                                <h2 class="mb-1 fw-bold text-primary">INVOICE</h2>
                                <p class="text-muted mb-0">#{{ $invoice->invoice_number }}</p>
                            </div>
                            <div class="text-end">
                                <h5 class="mb-1 fw-bold">{{ $invoice->lawyer->user->name ?? 'Lawyer' }}</h5>
                                <p class="text-muted mb-0">{{ $invoice->lawyer->user->email ?? '' }}</p>
                                <p class="text-muted mb-0">{{ $invoice->lawyer->city ?? '' }}</p>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-6">
                                <h6 class="text-uppercase text-muted small fw-bold mb-3">Bill To</h6>
                                <h5 class="mb-1 fw-bold">{{ Auth::user()->name }}</h5>
                                <p class="mb-0 text-muted">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="col-6 text-end">
                                <h6 class="text-uppercase text-muted small fw-bold mb-3">Status</h6>
                                @if ($invoice->status === 'paid')
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 fs-6">PAID</span>
                                @elseif($invoice->status === 'cancelled')
                                    <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3 py-2 fs-6">CANCELLED</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2 fs-6">UNPAID</span>
                                    <p class="text-muted small mb-0 mt-2">Due:
                                        {{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : 'N/A' }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="table-responsive mb-5">
                            <table class="table table-borderless">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="py-3 ps-4 rounded-start">Description</th>
                                        <th class="text-end py-3 pe-4 rounded-end">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="ps-4 py-3">{{ $invoice->description }}</td>
                                        <td class="text-end pe-4 py-3 fw-bold">${{ number_format($invoice->amount, 2) }}</td>
                                    </tr>
                                </tbody>
                                <tfoot class="border-top">
                                    <tr>
                                        <th class="ps-4 py-3 h5">Total</th>
                                        <th class="text-end pe-4 py-3 h5 text-primary">${{ number_format($invoice->amount, 2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="d-print-none mt-4 d-flex justify-content-between align-items-center">
                            <a href="{{ route('client.invoices.index') }}" class="btn btn-light rounded-pill px-4">
                                <i class="bi bi-arrow-left me-2"></i>Back
                            </a>
                            <div>
                                <button onclick="window.print()" class="btn btn-outline-primary rounded-pill px-4 me-2">
                                    <i class="bi bi-printer me-2"></i>Print
                                </button>
                                @if ($invoice->status === 'unpaid')
                                    <a href="{{ route('client.invoices.checkout', $invoice->id) }}"
                                        class="btn btn-primary rounded-pill px-4 shadow-sm">
                                        <i class="bi bi-credit-card me-2"></i>Pay Now
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
