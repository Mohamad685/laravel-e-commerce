<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function get_transactions()
    {
        $transactions = Transaction::with('order')->get();
        return response()->json([
            'transactions' => $transactions,
        ]);
    }

}
