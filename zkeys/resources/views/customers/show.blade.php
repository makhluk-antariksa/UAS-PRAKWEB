@extends('layouts.app')

@section('title', 'Customer Details - Zkeys Workshop')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user me-2"></i>Customer Details
        </h1>
        <p class="text-muted">View customer information and transaction history</p>
    </div>
    <div>
        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit me-1"></i>Edit
        </a>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back to Customers
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Customer Information</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Name:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $customer->name }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $customer->email }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Phone:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $customer->phone }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Address:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $customer->address }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Created:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $customer->created_at->format('d M Y H:i') }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Last Updated:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $customer->updated_at->format('d M Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Transaction Summary</h6>
                <a href="{{ route('transactions.create') }}?customer_id={{ $customer->id }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i>Add Transaction
                </a>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <strong>Total Transactions:</strong>
                    </div>
                    <div class="col-sm-6">
                        {{ $customer->transactions->count() }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <strong>Total Spent:</strong>
                    </div>
                    <div class="col-sm-6">
                        Rp {{ number_format($customer->transactions->where('status', 'Selesai')->sum('price')) }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <strong>Pending Transactions:</strong>
                    </div>
                    <div class="col-sm-6">
                        {{ $customer->transactions->where('status', 'Pending')->count() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Transaction History</h6>
    </div>
    <div class="card-body">
        @if($customer->transactions->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Service Type</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer->transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->transaction_date->format('d M Y') }}</td>
                            <td>{{ $transaction->service_type }}</td>
                            <td>Rp {{ number_format($transaction->price) }}</td>
                            <td>
                                @if($transaction->status == 'Pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($transaction->status == 'Selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-danger">Batal</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-exchange-alt fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No transactions found</h5>
                <p class="text-muted">This customer hasn't made any transactions yet.</p>
                <a href="{{ route('transactions.create') }}?customer_id={{ $customer->id }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Add Transaction
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 