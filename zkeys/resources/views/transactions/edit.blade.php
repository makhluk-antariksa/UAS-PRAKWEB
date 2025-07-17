@extends('layouts.app')

@section('title', 'Edit Transaction - Zkeys Workshop')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-edit me-2"></i>Edit Transaction
        </h1>
        <p class="text-muted">Update transaction information</p>
    </div>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Transactions
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Transaction Information</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="customer_id" class="form-label">Customer <span class="text-danger">*</span></label>
                        <select class="form-select @error('customer_id') is-invalid @enderror" 
                                id="customer_id" name="customer_id" required>
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" 
                                    {{ old('customer_id', $transaction->customer_id) == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }} ({{ $customer->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="transaction_date" class="form-label">Transaction Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('transaction_date') is-invalid @enderror" 
                               id="transaction_date" name="transaction_date" 
                               value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}" required>
                        @error('transaction_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="service_type" class="form-label">Service Type <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('service_type') is-invalid @enderror" 
                               id="service_type" name="service_type" 
                               value="{{ old('service_type', $transaction->service_type) }}" 
                               placeholder="e.g., Keyboard Repair, Custom Build" required>
                        @error('service_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="price" class="form-label">Price (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" 
                               id="price" name="price" value="{{ old('price', $transaction->price) }}" min="0" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                            <option value="Pending" {{ old('status', $transaction->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Selesai" {{ old('status', $transaction->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Batal" {{ old('status', $transaction->status) == 'Batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Update Transaction
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 