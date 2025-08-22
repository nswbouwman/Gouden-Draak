<x-cashdesk-layout>
    <div class="flex flex-col lg:flex-row gap-6 p-6">
        <div class="w-full lg:w-1/4 border p-4 rounded shadow">
            <h2 class="text-xl font-bold mb-4">{{ __('cashdesk/sales-overview.select-datums') }}</h2>
            <form id="salesForm">
                <label class="block mb-2">{{ __('cashdesk/sales-overview.start-date') }}</label>
                <input type="date" name="beginDate" class="w-full mb-4 p-2 border rounded" required>
                <label class="block mb-2">{{ __('cashdesk/sales-overview.end-date') }}</label>
                <input type="date" name="endDate" class="w-full mb-4 p-2 border rounded" required>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    {{ __('cashdesk/sales-overview.create-overview') }}
                </button>
            </form>
        </div>

        <div class="w-full lg:w-3/4 border p-4 rounded shadow">
            <h2 class="text-xl font-bold mb-4">{{ __('cashdesk/sales-overview.overview') }}</h2>
            <table class="w-full text-left border-collapse">
                <thead class="border-b-2">
                    <tr>
                        <th>{{ __('cashdesk/sales-overview.date') }}</th>
                        <th>{{ __('cashdesk/sales-overview.dish') }}</th>
                        <th>{{ __('cashdesk/sales-overview.price') }}</th>
                        <th>{{ __('cashdesk/sales-overview.quantity') }}</th>
                        <th>{{ __('cashdesk/sales-overview.subtotal') }}</th>
                    </tr>
                </thead>
                <tbody id="salesTableBody"></tbody>
            </table>
            <div class="mt-4 text-lg font-semibold">
                <p>{{ __('cashdesk/sales-overview.revenue') }} € <span id="total">0,00</span></p>
                <p>{{ __('cashdesk/sales-overview.vat') }} € <span id="vat">0,00</span></p>
                <p>{{ __('cashdesk/sales-overview.no-vat') }} € <span id="exVat">0,00</span></p>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/sales-overview.js') }}"></script>
</x-cashdesk-layout>
