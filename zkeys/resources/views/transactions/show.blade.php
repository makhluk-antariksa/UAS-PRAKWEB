@extends('layouts.app')

@section('title', 'Transaction Details - Zkeys Workshop')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-exchange-alt me-2"></i>Transaction Details
        </h1>
        <p class="text-muted">View transaction information</p>
    </div>
    <div>
        <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit me-1"></i>Edit
        </a>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back to Transactions
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Transaction Information</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Transaction ID:</strong>
                    </div>
                    <div class="col-sm-8">
                        #{{ $transaction->id }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Customer:</strong>
                    </div>
                    <div class="col-sm-8">
                        <a href="{{ route('customers.show', $transaction->customer->id) }}">
                            {{ $transaction->customer->name }}
                        </a>
                        <br>
                        <small class="text-muted">{{ $transaction->customer->email }}</small>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Transaction Date:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $transaction->transaction_date->format('d M Y') }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Service Type:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $transaction->service_type }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Price:</strong>
                    </div>
                    <div class="col-sm-8">
                        <span class="h5 text-success">Rp {{ number_format($transaction->price) }}</span>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Status:</strong>
                    </div>
                    <div class="col-sm-8">
                        @if($transaction->status == 'Pending')
                            <span class="badge bg-warning fs-6">Pending</span>
                        @elseif($transaction->status == 'Selesai')
                            <span class="badge bg-success fs-6">Selesai</span>
                        @else
                            <span class="badge bg-danger fs-6">Batal</span>
                        @endif
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Created:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $transaction->created_at->format('d M Y H:i') }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Last Updated:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $transaction->updated_at->format('d M Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Customer Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Name:</strong><br>
                    {{ $transaction->customer->name }}
                </div>
                
                <div class="mb-3">
                    <strong>Email:</strong><br>
                    {{ $transaction->customer->email }}
                </div>
                
                <div class="mb-3">
                    <strong>Phone:</strong><br>
                    {{ $transaction->customer->phone }}
                </div>
                
                <div class="mb-3">
                    <strong>Address:</strong><br>
                    {{ $transaction->customer->address }}
                </div>
                
                <a href="{{ route('customers.show', $transaction->customer->id) }}" class="btn btn-info btn-sm">
                    <i class="fas fa-user me-1"></i>View Customer Details
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 