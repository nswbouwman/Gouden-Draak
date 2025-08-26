<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DishType;
use App\Models\Order;
use App\Models\MenuItem;
use App\Models\OrderItem;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\App;

class OrderController extends Controller
{
    public function index($table_nr)
    {
        $locale = substr(request()->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
        if (in_array($locale, ['en', 'nl'])) {
            App::setLocale($locale);
        }

        $dishTypes = DishType::with(['menuItems' => function ($query) {
            $query->orderBy('menu_number')->orderBy('menu_suffix');
        }])->get();

        $latestOrderTime = Order::where('table_nr', $table_nr)->orderBy('created_at', 'desc')->first();

        if (!$latestOrderTime) {
            $timeDifference = 10;
        } else {
            $timeDifference = -now()->diffInMinutes($latestOrderTime->created_at);
        }

        $orderCount = Order::where('table_nr', $table_nr)->count();

        $dishHistory = Order::where('table_nr', $table_nr)
            ->with('items.menuItem')
            ->orderBy('created_at', 'desc')
            ->get();

        $dishHistory = $dishHistory->flatMap(function ($order) {
            return $order->items;
        })->unique('menu_item_id')->values();

        $url = route('form.index');
        $qr = QrCode::size(200)->generate($url);

        return view('orders', compact('table_nr', 'dishTypes', 'qr', 'orderCount', 'timeDifference', 'dishHistory'));
    }

    public function store(Request $request, $table_nr)
    {
        $latestOrderTime = Order::where('table_nr', $table_nr)->orderBy('created_at', 'desc')->first();
        $placedOrderAmount = Order::where('table_nr', $table_nr)->count();

        if ($placedOrderAmount > 0) {
            if ($placedOrderAmount >= 5) {
                return response()->json([
                    'success' => false,
                    'message' => __('orders.max-orders-reached')
                ], 429);
            }

            $timeDifference = -now()->diffInMinutes($latestOrderTime->created_at);

            if ($timeDifference < 10) {
                return response()->json([
                    'success' => false,
                    'message' => __('orders.wait-minutes', ['minutes' => round(10 - $timeDifference, 2)])
                ], 429);
            }
        }

        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1|max:20',
        ]);

        $order = Order::create([
            'table_nr' => $table_nr,
        ]);

        foreach ($validated['items'] as $item) {
            $menuItem = MenuItem::find($item['id']);

            // Use offer price if item is on offer and has an offer price, otherwise use regular price
            $price = ($menuItem->is_offer && $menuItem->offer_price) ? $menuItem->offer_price : $menuItem->price;

            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $menuItem->id,
                'quantity' => $item['quantity'],
                'price' => $price,
            ]);
        }

        return response()->json(['success' => true]);
    }
}
