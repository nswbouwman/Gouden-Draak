<x-app-layout>
    <x-navbar-with-border>
        <h1 class="text-3xl font-bold mb-6">{{ __('offers.week-offer') }}</h1>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($offers as $offer)
                <div class="border rounded p-4 shadow">
                    <h2 class="text-xl font-semibold">{{ $offer->name }}</h2>
                    <p class="text-gray-600">{{ $offer->description }}</p>
                    <p class="mt-2">
                        <span class="line-through text-red-500">€{{ number_format($offer->price, 2, ',', '.') }}</span>
                        <span class="text-green-600 font-bold">€{{ number_format($offer->offer_price, 2, ',', '.') }}</span>
                    </p>
                </div>
            @empty
                <p>{{ __('offers.no-offers') }}</p>
            @endforelse
        </div>
    </x-navbar-with-border>
</x-app-layout>