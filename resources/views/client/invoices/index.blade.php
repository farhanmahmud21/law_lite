@extends('layouts.landing')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 fw-bold">{{ __('messages.my_invoices') }}</h2>

        @if ($invoices->isEmpty())
            <div class="alert alert-info shadow-sm border-0">{{ __('messages.no_invoices') ?? 'You have no invoices.' }}</div>
        @else
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
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td class="ps-4 fw-semibold">#{{ $invoice->invoice_number }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                    {{ substr($invoice->lawyer->user->name ?? 'U', 0, 1) }}
                                                </div>
                                                {{ $invoice->lawyer->user->name ?? 'Unknown' }}
                                            </div>
                                        </td>
                                        <td class="fw-bold">${{ number_format($invoice->amount, 2) }}</td>
                                        <td class="text-muted">{{ $invoice->created_at->format('M d, Y') }}</td>
                                        <td>
                                            @if ($invoice->status === 'paid')
                                                <span class="badge bg-success-subtle text-success rounded-pill px-3">Paid</span>
                                            @elseif($invoice->status === 'cancelled')
                                                <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3">Cancelled</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3">Unpaid</span>
                                            @endif
                                        </td>
                                        <td class="pe-4 text-end">
                                            <a href="{{ route('client.invoices.show', $invoice->id) }}"
                                                class="btn btn-sm btn-outline-primary rounded-pill px-3">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
