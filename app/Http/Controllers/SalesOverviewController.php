<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class SalesOverviewController extends Controller
{
    public function index()
    {
        return view('cashdesk.sales-overview');
    }

    public function data(Request $request)
    {
        $request->validate([
            'beginDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:beginDate',
        ]);

        $data = OrderItem::select(
                DB::raw('DATE(orders.created_at) as sale_date'),
                'menu_items.name as dish_name',
                'order_items.price',
                'order_items.quantity',
                DB::raw('(order_items.price * order_items.quantity) as subtotal')
            )
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('menu_items', 'menu_items.id', '=', 'order_items.menu_item_id')
            ->whereBetween(DB::raw('DATE(orders.created_at)'), [$request->beginDate, $request->endDate])
            ->orderBy('orders.created_at', 'asc')
            ->get();

        return response()->json($data);
    }
}
