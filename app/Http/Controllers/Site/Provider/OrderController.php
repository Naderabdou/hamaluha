<?php

namespace App\Http\Controllers\Site\Provider;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
class OrderController extends Controller
{
   public function index(Request $request)
{
    $latestOrders = Order::with('orderItems')->latest()->take(5)->get();

    $orders = Order::with('user', 'orderItems')
        ->when($request->date_filter, function ($query, $date_filter) {
            if ($date_filter === 'today') {
                $query->whereDate('created_at', Carbon::today());
            } elseif ($date_filter === 'week') {
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            } elseif ($date_filter === 'month') {
                $query->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
            }
        })
        ->latest()
        ->paginate(10);

    return view('provider.orders.index', compact('latestOrders', 'orders'));
}

    // عرض تفاصيل طلب معين
    public function show($id)
    {
        $order = Order::with('user', 'orderItems.product', 'orderItems.store')
            ->findOrFail($id);

        return view('provider.orders.show', compact('order'));
    }
}
