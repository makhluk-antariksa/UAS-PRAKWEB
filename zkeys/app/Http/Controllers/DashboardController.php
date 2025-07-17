<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::count();
        $totalTransactions = Transaction::count();
        $totalRevenue = Transaction::where('status', 'Selesai')->sum('price');
        $pendingTransactions = Transaction::where('status', 'Pending')->count();
        
        $recentTransactions = Transaction::with('customer')
            ->orderBy('transaction_date', 'desc')
            ->limit(5)
            ->get();
            
        $recentCustomers = Customer::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('dashboard', compact(
            'totalCustomers',
            'totalTransactions', 
            'totalRevenue',
            'pendingTransactions',
            'recentTransactions',
            'recentCustomers'
        ));
    }
}
