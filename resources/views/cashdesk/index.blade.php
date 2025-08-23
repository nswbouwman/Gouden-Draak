<x-cashdesk-layout>
    <div class="w-full">
        <div class="flex mt-5 h-[600px]">
            <!-- Left Side -->
            <div class="w-[60%] pr-4 border-r-2 border-blue-600 box-border">
                <!-- Search and Filter Bar -->
                <div class="flex items-center gap-4 mb-4 w-full">
                    <input type="text" id="searchInput" placeholder="{{ __('cashdesk/index.search') }}"
                        class="border rounded px-2 py-1 w-full max-w-[70%]">
                    <select id="categoryFilter" class="border rounded px-2 py-1 w-full max-w-[30%]">
                        <option value="">{{ __('cashdesk/index.all-categories') }}</option>
                        @endphp
                        @foreach ($dishTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    <button id="clearFilter" type="button"
                        class="ml-2 px-3 py-1 border rounded bg-gray-200 hover:bg-gray-300">{{ __('cashdesk/index.reset') }}</button>
                </div>
                <div class="p-5 h-full w-full border border-blue-600 rounded-l-md overflow-y-scroll box-border">
                    @foreach ($dishTypes as $type)
                        <div class="dish-type-block" data-type-id="{{ $type->id }}">
                            <div class="text-lg font-bold text-center my-2 first:mt-0">{{ $type->name }}</div>
                            <table class="w-full mb-4">
                                <tbody>
                                    @foreach ($type->menuItems as $item)
                                        <tr class="menu-row" data-name="{{ strtolower($item->name) }}"
                                            data-number="{{ $item->menu_number }}{{ $item->menu_suffix }}"
                                            data-type-id="{{ $type->id }}">
                                            <td class="w-[10%] align-top">
                                                {{ $item->menu_number }}{{ $item->menu_suffix }}.</td>
                                            <td class="w-[70%]">
                                                {!! $item->name !!}
                                                @if (!empty($item->description))
                                                    <span class="text-gray-500 italic">({!! $item->description !!})</span>
                                                @endif
                                            </td>
                                            <td class="w-[10%] min-w-[70px]">€
                                                {{ number_format($item->price, 2, ',', ' ') }}</td>
                                            <td>
                                                <button
                                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded addMenuItem"
                                                    value="{{ $item->id }}">{{ __('cashdesk/index.add') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Right Side -->
            <div class="w-[40%] pl-4 box-border">
                <div class="h-full flex flex-col justify-between">
                    <!-- Order -->
                    <div class="p-5 h-[85%] w-full border border-blue-600 rounded-l-md overflow-y-scroll box-border">
                        <div class="text-lg font-bold text-center mb-4">{{ __('cashdesk/index.order') }}</div>
                        <table class="w-full itemSelectedTable">
                            @foreach ($dishTypes as $type)
                                @foreach ($type->menuItems as $item)
                                    <tr class="hidden menuItem_{{ $item->id }}" data-price="{{ $item->price }}">
                                        <td class="w-[10%] align-top">
                                            {{ $item->menu_number }}{{ $item->menu_suffix }}.</td>
                                        <td class="w-[40%]">
                                            {!! $item->name !!}
                                            @if (!empty($item->description))
                                                <i>({!! $item->description !!})</i>
                                            @endif
                                        </td>
                                        <td class="w-[10%] min-w-[70px]">
                                            <span>€ </span><span
                                                class="subAmount">{{ number_format($item->price, 2, ',', ' ') }}</span>
                                        </td>
                                        <td class="w-[40%]">
                                            <input type="number" name="{{ $item->id }}" min="0"
                                                value="0" class="w-full border rounded px-1 py-0.5">
                                            <select class="remarkSelect w-full mt-1 border rounded px-1 py-0.5">
                                                <option value="">{{ __('cashdesk/index.choose-common-remark') }}
                                                </option>
                                                @foreach ($remarks ?? [] as $remark)
                                                    <option value="{{ $remark }}">{{ $remark }}</option>
                                                @endforeach
                                                <option value="__custom__">{{ __('cashdesk/index.choose-own-remark') }}
                                                </option>
                                            </select>
                                            <input type="text"
                                                class="remarkInput w-full mt-1 border rounded px-1 py-0.5 hidden"
                                                placeholder="{{ __('cashdesk/index.own-remark') }}">
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
                                <td class="w-[50%]">{{ __('cashdesk/index.total') }}</td>
                                <td class="w-[15%]">
                                    <span>€ </span><span class="totalAmount">0,00</span>
                                </td>
                                <td class="w-[25%] flex space-x-2">
                                    <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded"
                                        id="payOrder">{{ __('cashdesk/index.pay') }}</button>
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded"
                                        id="clearOrder">{{ __('cashdesk/index.delete') }}</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-cashdesk-layout>

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
                const remarkSelect = row.querySelector('.remarkSelect');
                const remarkInput = row.querySelector('.remarkInput');
                const id = input.name;
                const qty = parseInt(input.value);
                let remark = '';
                if (remarkSelect.value === '__custom__') {
                    remark = remarkInput.value;
                } else {
                    remark = remarkSelect.value;
                }
                if (qty > 0) {
                    items.push({
                        id,
                        quantity: qty,
                        remark
                    });
                }
            });

            if (items.length === 0) {
                alert("{{ __('cashdesk/index.no-items-selected') }}");
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
                alert("{{ __('cashdesk/index.order-success') }}");
                location.reload();
            } else {
                alert("{{ __('cashdesk/index.order-error') }}");
            }
        });
    });

    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');

    function filterMenu() {
        const search = searchInput.value.trim().toLowerCase();
        const category = categoryFilter.value;

        document.querySelectorAll('.dish-type-block').forEach(block => {
            let blockHasVisible = false;
            const typeId = block.getAttribute('data-type-id');
            block.querySelectorAll('.menu-row').forEach(row => {
                const name = row.getAttribute('data-name');
                const number = row.getAttribute('data-number');
                const rowTypeId = row.getAttribute('data-type-id');
                let visible = true;

                if (category && rowTypeId !== category) visible = false;
                if (search && !(name.includes(search) || number.toLowerCase().includes(search)))
                    visible = false;

                row.style.display = visible ? '' : 'none';
                if (visible) blockHasVisible = true;
            });

            block.style.display = blockHasVisible ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterMenu);
    categoryFilter.addEventListener('change', filterMenu);

    document.getElementById('clearFilter').addEventListener('click', function() {
        searchInput.value = '';
        categoryFilter.value = '';
        filterMenu();
    });

    document.querySelectorAll('.remarkSelect').forEach(select => {
        select.addEventListener('change', function() {
            const input = select.closest('td').querySelector('.remarkInput');
            if (select.value === '__custom__') {
                input.classList.remove('hidden');
                input.value = '';
                input.focus();
            } else {
                input.classList.add('hidden');
                input.value = select.value;
            }
        });
    });
</script>
