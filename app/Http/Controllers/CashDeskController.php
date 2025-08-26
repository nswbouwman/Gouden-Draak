<?php

namespace App\Http\Controllers;

use App\Models\DishType;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CashDeskController extends Controller
{
    public function index()
    {
        $locale = substr(request()->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
        if (in_array($locale, ['en', 'nl'])) {
            App::setLocale($locale);
        }

        $dishTypes = DishType::with(['menuItems' => function ($query) {
            $query->orderBy('menu_number')->orderBy('menu_suffix');
        }])->get();

        $remarks = OrderItem::whereNotNull('remark')
            ->where('remark', '!=', '')
            ->selectRaw('remark, COUNT(*) as count')
            ->groupBy('remark')
            ->orderByDesc('count')
            ->limit(10)
            ->pluck('remark');

        return view('cashdesk.index', compact('dishTypes', 'remarks'));
    }

    public function storeOrder(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.remark' => 'nullable|string|max:255',
        ]);

        $order = Order::create();

        foreach ($validated['items'] as $item) {
            $menuItem = MenuItem::find($item['id']);

            $price = ($menuItem->is_offer && $menuItem->offer_price) ? $menuItem->offer_price : $menuItem->price;

            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $menuItem->id,
                'quantity' => $item['quantity'],
                'price' => $price,
                'remark' => $item['remark'] ?? null,
            ]);
        }

        return response()->json(['success' => true, 'order_id' => $order->id]);
    }

    public function menu()
    {
        $locale = substr(request()->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
        if (in_array($locale, ['en', 'nl'])) {
            App::setLocale($locale);
        }

        $menuItems = MenuItem::with('dishType')
            ->get()
            ->sortBy(function ($item) {
                return $item->dishType->name . '-' . str_pad($item->menu_number ?? 0, 3, '0', STR_PAD_LEFT);
            })
            ->groupBy(function ($item) {
                return $item->dishType->name;
            });

        return view('cashdesk.menu', compact('menuItems'));
    }

    public function salesOverview()
    {
        $locale = substr(request()->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
        if (in_array($locale, ['en', 'nl'])) {
            App::setLocale($locale);
        }

        return view('cashdesk.sales-overview');
    }

    public function salesOverviewData(Request $request)
    {
        $locale = substr(request()->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
        if (in_array($locale, ['en', 'nl'])) {
            App::setLocale($locale);
        }

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
