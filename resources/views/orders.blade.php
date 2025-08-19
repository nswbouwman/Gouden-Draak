<x-app-layout>
    <x-slider-with-border-tablet>
        <h1 class="text-4xl font-bold">Bestellen</h1>
        <h2 class="text-2xl font-bold">Tafel {{ $table_nr }}</h2>
        <p class="mb-4">Bevestigen doe je onderaan!</p>

        <div class="p-4 bg-white rounded shadow text-sm font-serif max-w-6xl mx-auto">
            @foreach ($dishTypes as $type)
                <div class="mb-8 break-inside-avoid-column">
                    <h2 class="text-xl font-bold border-b border-gray-300 mb-2 pe-46">
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
                                        @if ($item->description)
                                            <span class="text-gray-500 italic">({!! $item->description !!})</span>
                                        @endif
                                    </span>
                                </div>
                                <span class="ml-4 me-4 w-14">€ {{ number_format($item->price, 2, ',', '.') }}</span>
                                <button
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded addMenuItem w-24"
                                    value="{{ $item->id }}">Toevoegen</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <!-- Order -->
        <div class="p-5 h-[85%] w-full border border-blue-600 rounded-l-md overflow-y-scroll box-border">
            <div class="text-lg font-bold text-center mb-4">Bestelling</div>
            <table class="w-full itemSelectedTable">
                @foreach ($dishTypes as $type)
                    @foreach ($type->menuItems as $item)
                        <tr class="hidden menuItem_{{ $item->id }}" data-price="{{ $item->price }}">
                            <td class="w-[10%] align-top">{{ $item->menu_number }}{{ $item->menu_suffix }}.</td>
                            <td class="w-[65%]">
                                {!! $item->name !!}
                                @if (!empty($item->description))
                                    <i>({!! $item->description !!})</i>
                                @endif
                            </td>
                            <td class="w-[10%] min-w-[70px]">
                                <span>€ </span><span
                                    class="subAmount">{{ number_format($item->price, 2, ',', ' ') }}</span>
                            </td>
                            <td class="w-[15%]">
                                <input type="number" name="{{ $item->id }}" min="0" max="20"
                                    value="0" class="w-full border rounded px-1 py-0.5">
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
        </div>

        <!-- Total -->
        <div class="p-4 h-[15%] w-full border border-blue-600 rounded box-border mt-2">
            <table class="w-full text-xl font-bold">
                <tr>
                    <td class="w-[10%]"></td>
                    <td class="w-[50%]">Totaal:</td>
                    <td class="w-[15%]">
                        <span>€ </span><span class="totalAmount">0,00</span>
                    </td>
                    <td class="w-[25%] flex space-x-2">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded"
                            id="payOrder">Afrekenen</button>
                        <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded"
                            id="clearOrder">Verwijderen</button>
                    </td>
                </tr>
            </table>
        </div>
    </x-slider-with-border-tablet>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.itemSelectedTable tr:not(.hidden)').forEach(row => {
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
                row.classList.remove('hidden');
                input.value = parseInt(input.value) + 1;
                updateTotal();
            });
        });

        // Change input value
        document.querySelectorAll('.itemSelectedTable input[type="number"]').forEach(input => {
            input.addEventListener('input', () => {
                const row = input.closest('tr');
                if (parseInt(input.value) <= 0) {
                    input.value = 0;
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
            document.querySelectorAll('.itemSelectedTable tr').forEach(row => {
                row.classList.add('hidden');
                row.querySelector('input').value = 0;
            });
            updateTotal();
        });

        // Pay Order
        document.getElementById('payOrder').addEventListener('click', async () => {
            const items = [];
            document.querySelectorAll('.itemSelectedTable tr:not(.hidden)').forEach(row => {
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
                alert("Geen gerechten geselecteerd.");
                return;
            }

            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const response = await fetch('/orders', {
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
                alert("Bestelling succesvol geplaatst!");
                location.reload();
            } else {
                alert("Er is een fout opgetreden.");
            }
        });
    });
</script>
