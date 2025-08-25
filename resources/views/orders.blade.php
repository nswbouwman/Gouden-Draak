<x-app-layout>
    <x-slider-with-border-tablet>
        <h1 class="text-4xl font-bold">{{ __('orders.order') }}</h1>
        <h2 class="text-2xl font-bold">{{ __('orders.table') }} {{ $table_nr }}</h2>
        <p class="mb-4 text-lg">{{ __('orders.below') }}</p>

        <div class="p-4 bg-white rounded-t shadow text-sm font-serif max-w-6xl mx-auto">
            @foreach ($dishTypes as $type)
                <div class="mb-8 break-inside-avoid-column">
                    <h2 class="text-xl font-bold border-b border-gray-300 mb-2 pe-[11.5rem]">
                        {{ strtoupper($type->name) }}
                    </h2>
                    <ul>
                        @foreach ($type->menuItems as $item)
                            <li
                                class="flex justify-between items-center py-1 border-b border-dotted border-gray-300 group">
                                <div class="flex items-center flex-1">
                                    <span class="flex-1">
                                        @if ($item->menu_number)
                                            {{ $item->menu_number }}{{ $item->menu_suffix }}.
                                        @else
                                            @if ($item->menu_suffix)
                                                {{ $item->menu_suffix }}.
                                            @endif
                                        @endif
                                        {!! $item->name !!}
                                        @if ($item->is_offer)
                                            <span class="bg-red-500 text-white px-2 py-1 text-xs rounded ml-2">AANBIEDING</span>
                                        @endif
                                        @if ($item->description)
                                            <span class="text-gray-500 italic">({!! $item->description !!})</span>
                                        @endif
                                    </span>
                                </div>
                                <span class="ml-4 me-4 w-14">
                                    @if ($item->is_offer && $item->offer_price)
                                        <span class="line-through text-gray-500 text-xs block">€ {{ number_format($item->price, 2, ',', '.') }}</span>
                                        <span class="text-red-600 font-bold">€ {{ number_format($item->offer_price, 2, ',', '.') }}</span>
                                    @else
                                        € {{ number_format($item->price, 2, ',', '.') }}
                                    @endif
                                </span>
                                <button
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded addMenuItem w-24"
                                    value="{{ $item->id }}">{{ __('orders.add') }}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <!-- Order -->
        <div class="p-4 bg-white shadow text-sm font-serif max-w-6xl mx-auto">
            <div class="text-lg font-bold text-center mb-4 pe-[11.5rem]">{{ __('orders.in-order') }}</div>
            <div class="pe-[11.5rem] text-lg" id="empty">{{ __('orders.empty-order') }}</div>
            <ul class="itemSelectedList">
                @foreach ($dishTypes as $type)
                    @foreach ($type->menuItems as $item)
                        @php
                            $displayPrice = $item->is_offer && $item->offer_price ? $item->offer_price : $item->price;
                        @endphp
                        <li class="hidden menuItem_{{ $item->id }} flex items-center border-b border-dotted border-gray-300 py-2"
                            data-price="{{ $displayPrice }}">
                            <div class="flex items-center flex-1">
                                <span class="flex-1">
                                    @if ($item->menu_number)
                                        {{ $item->menu_number }}{{ $item->menu_suffix }}.
                                    @else
                                        @if ($item->menu_suffix)
                                            {{ $item->menu_suffix }}.
                                        @endif
                                    @endif
                                    {!! $item->name !!}
                                    @if ($item->is_offer)
                                        <span class="bg-red-500 text-white px-1 py-0.5 text-xs rounded ml-1">AANBIEDING</span>
                                    @endif
                                    @if ($item->description)
                                        <span class="text-gray-500 italic">({!! $item->description !!})</span>
                                    @endif
                                </span>
                            </div>
                            <span class="ml-4 me-4 w-14">€ <span
                                    class="subAmount">{{ number_format($displayPrice, 2, ',', '.') }}</span></span>
                            <div class="w-24">
                                <input type="number" name="{{ $item->id }}" min="0" max="20"
                                    value="0" class="w-full border rounded px-1 py-0.5">
                            </div>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>

        <!-- Total -->
        <div class="p-4 bg-white rounded-b shadow text-sm font-serif max-w-6xl mx-auto">
            <div class="pe-[11.5rem] text-lg">
                <div class="flex justify-center mb-4">
                    <p class="me-8">{{ __('orders.total') }}</p>
                    <span>€ </span><span class="totalAmount">0,00</span>
                </div>
                <div id="vue-menu" class="flex justify-center space-x-8">
                    <order-button>{{ __('orders.order') }}</order-button>
                    <delete-button>{{ __('orders.delete') }}</delete-button>
                </div>
            </div>
            @if ($orderCount > 0)
                <div class="pe-[11.5rem]">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-12 py-3 rounded mt-8 text-lg"
                        id="pay">{{ __('orders.pay') }}</button>
                </div>
            @endif
        </div>
        <div class="p-4 bg-white rounded-b shadow text-sm font-serif max-w-6xl mx-auto flex justify-center pe-[12.5rem] hidden"
            id="qr">
            <p>{!! $qr !!}</p>
        </div>
    </x-slider-with-border-tablet>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let emptyState = document.getElementById('empty');

        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.itemSelectedList li:not(.hidden)').forEach(row => {
                const input = row.querySelector('input[type="number"]');
                const price = parseFloat(row.dataset.price);
                const qty = parseInt(input.value);
                if (!isNaN(price) && !isNaN(qty)) {
                    total += qty * price;
                }
            });
            document.querySelector('.totalAmount').innerText = total.toFixed(2).replace('.', ',');
        }

        // Add Menu Item
        document.querySelectorAll('.addMenuItem').forEach(button => {
            button.addEventListener('click', () => {
                const itemId = button.value;
                const row = document.querySelector(`.menuItem_${itemId}`);
                const input = row.querySelector('input[type="number"]');
                emptyState.classList.add('hidden');
                row.classList.remove('hidden');
                input.value = parseInt(input.value) + 1;
                updateTotal();
            });
        });

        // Change input value
        document.querySelectorAll('.itemSelectedList input[type="number"]').forEach(input => {
            input.addEventListener('input', () => {
                const row = input.closest('li');
                if (parseInt(input.value) <= 0) {
                    input.value = 0;
                    if (document.querySelectorAll('.itemSelectedList li:not(.hidden)')
                        .length === 1) {
                        emptyState.classList.remove('hidden');
                    }
                    row.classList.add('hidden');
                }
                if (parseInt(input.value) > 20) {
                    input.value = 20;
                }
                updateTotal();
            });
        });

        // Clear Order
        document.getElementById('clearOrder').addEventListener('click', () => {
            document.querySelectorAll('.itemSelectedList li').forEach(row => {
                row.classList.add('hidden');
                row.querySelector('input').value = 0;
            });
            emptyState.classList.remove('hidden');
            updateTotal();
        });

        // Pay Order
        document.getElementById('payOrder').addEventListener('click', async () => {
            const items = [];
            document.querySelectorAll('.itemSelectedList li:not(.hidden)').forEach(row => {
                const input = row.querySelector('input[type="number"]');
                const id = input.name;
                const qty = parseInt(input.value);
                if (qty > 0) {
                    items.push({
                        id,
                        quantity: qty
                    });
                }
            });

            if (items.length === 0) {
                alert("{{ __('orders.no-dishes') }}");
                return;
            }

            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const response = await fetch(`/bestellingen/{{ $table_nr }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({
                    items
                })
            });

            const result = await response.json();

            if (result.success) {
                alert("{{ __('orders.order-placed') }}");
                location.reload();
            } else if (result.message) {
                alert(result.message);
            } else {
                alert("{{ __('orders.order-error') }}");
            }
        });

        document.getElementById('pay').addEventListener('click', function() {
            document.getElementById('qr').classList.remove('hidden');
        });
    });
</script>