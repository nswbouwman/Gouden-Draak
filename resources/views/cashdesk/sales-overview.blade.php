<x-admin-layout>
    <div class="flex flex-col lg:flex-row gap-6 p-6">
        <div class="w-full lg:w-1/4 border p-4 rounded shadow">
            <h2 class="text-xl font-bold mb-4">Selecteer datums</h2>
            <form id="salesForm">
                <label class="block mb-2">Begin datum:</label>
                <input type="date" name="beginDate" class="w-full mb-4 p-2 border rounded" required>
                <label class="block mb-2">Eind datum:</label>
                <input type="date" name="endDate" class="w-full mb-4 p-2 border rounded" required>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Maak Overzicht
                </button>
            </form>
        </div>

        <div class="w-full lg:w-3/4 border p-4 rounded shadow">
            <h2 class="text-xl font-bold mb-4">Overzicht</h2>
            <table class="w-full text-left border-collapse">
                <thead class="border-b-2">
                    <tr>
                        <th>Datum</th>
                        <th>Gerecht</th>
                        <th>Prijs</th>
                        <th>Aantal</th>
                        <th>Subtotaal</th>
                    </tr>
                </thead>
                <tbody id="salesTableBody"></tbody>
            </table>
            <div class="mt-4 text-lg font-semibold">
                <p>Omzet: € <span id="total">0,00</span></p>
                <p>BTW (21%): € <span id="vat">0,00</span></p>
                <p>Excl. BTW: € <span id="exVat">0,00</span></p>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/sales-overview.js') }}"></script>
</x-admin-layout>
