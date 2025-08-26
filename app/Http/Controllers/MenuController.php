<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\DishType;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function menu(Request $request)
    {
        $locale = substr(request()->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
        if (in_array($locale, ['en', 'nl'])) {
            App::setLocale($locale);
        }

        $favorites = $this->getFavoritesFromCookie($request);
        $sortType = $request->get('sort', 'default'); // 'default', 'favorites-number', 'favorites-alpha'

        $menuItems = MenuItem::with('dishType')->get();

        // Add favorite status to each item
        $menuItems = $menuItems->map(function ($item) use ($favorites) {
            $item->is_favorite = in_array($item->id, $favorites);
            return $item;
        });

        $groupedItems = collect();

        switch ($sortType) {
            case 'favorites-number':
                // Sort favorites at top by number
                $favoriteItems = $menuItems->where('is_favorite', true);
                $regularItems = $menuItems->where('is_favorite', false);

                if ($favoriteItems->count() > 0) {
                    $sortedFavorites = $favoriteItems->sortBy(function ($item) {
                        return $item->dishType->name . '-' . str_pad($item->menu_number ?? 0, 3, '0', STR_PAD_LEFT);
                    });
                    $groupedItems->put('FAVORITES', $sortedFavorites);
                }

                $regularItemsGrouped = $regularItems
                    ->sortBy(function ($item) {
                        return $item->dishType->name . '-' . str_pad($item->menu_number ?? 0, 3, '0', STR_PAD_LEFT);
                    })
                    ->groupBy(function ($item) {
                        return $item->dishType->name;
                    });

                foreach ($regularItemsGrouped as $category => $items) {
                    $groupedItems->put($category, $items);
                }
                break;

            case 'favorites-alpha':
                // Sort favorites at top alphabetically
                $favoriteItems = $menuItems->where('is_favorite', true);
                $regularItems = $menuItems->where('is_favorite', false);

                if ($favoriteItems->count() > 0) {
                    $sortedFavorites = $favoriteItems->sortBy(function ($item) {
                        return strtolower(strip_tags($item->name));
                    });
                    $groupedItems->put('FAVORITES', $sortedFavorites);
                }

                $regularItemsGrouped = $regularItems
                    ->sortBy(function ($item) {
                        return $item->dishType->name . '-' . str_pad($item->menu_number ?? 0, 3, '0', STR_PAD_LEFT);
                    })
                    ->groupBy(function ($item) {
                        return $item->dishType->name;
                    });

                foreach ($regularItemsGrouped as $category => $items) {
                    $groupedItems->put($category, $items);
                }
                break;

            default:
                // Default sort
                $groupedItems = $menuItems
                    ->sortBy(function ($item) {
                        return $item->dishType->name . '-' . str_pad($item->menu_number ?? 0, 3, '0', STR_PAD_LEFT);
                    })
                    ->groupBy(function ($item) {
                        return $item->dishType->name;
                    });
                break;
        }

        return view('menu', compact('groupedItems', 'favorites', 'sortType'));
    }

    public function toggleFavorite(Request $request)
    {
        $itemId = $request->input('item_id');
        $favorites = $this->getFavoritesFromCookie($request);

        if (in_array($itemId, $favorites)) {
            $favorites = array_values(array_diff($favorites, [$itemId]));
        } else {
            $favorites[] = $itemId;
        }

        // Store in cookie for 1 year
        $cookie = cookie('menu_favorites', json_encode($favorites), 525600);

        return response()->json(['success' => true, 'is_favorite' => in_array($itemId, $favorites)])
            ->cookie($cookie);
    }

    private function getFavoritesFromCookie(Request $request)
    {
        $favoritesJson = $request->cookie('menu_favorites');
        return $favoritesJson ? json_decode($favoritesJson, true) : [];
    }
}
