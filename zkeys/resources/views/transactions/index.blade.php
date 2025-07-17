@extends('layouts.app')

@section('title', 'Transactions - Zkeys Workshop')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-exchange-alt me-2"></i>Transactions
        </h1>
        <p class="text-muted">Manage transaction data</p>
    </div>
    <a href="{{ route('transactions.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add Transaction
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form method="GET" action="{{ route('transactions.index') }}" class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search transactions..." value="{{ $search }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-6 text-end">
                @if($search)
                    <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Clear Search
                    </a>
                @endif
            </div>
        </form>
    </div>
    <div class="card-body">
        @if($transactions->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Service Type</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->transaction_date->format('d M Y') }}</td>
                            <td>{{ $transaction->customer->name }}</td>
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
                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this transaction?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center">
                {{ $transactions->appends(['search' => $search])->links() }}
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-exchange-alt fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No transactions found</h5>
                <p class="text-muted">Start by adding your first transaction.</p>
                <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Add Transaction
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 