<x-admin-layout>
    <h1 class="text-2xl font-bold mb-4">Nieuw gerecht toevoegen</h1>

    <form action="{{ route('admin.menu.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label>Categorie</label>
            <select name="dish_type_id" class="border rounded p-2 w-full">
                @foreach($dishTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Naam</label>
            <input type="text" name="name" class="border rounded p-2 w-full">
        </div>

        <div>
            <label>Beschrijving</label>
            <textarea name="description" class="border rounded p-2 w-full"></textarea>
        </div>

        <div>
            <label>Prijs</label>
            <input type="number" step="0.01" name="price" class="border rounded p-2 w-full">
        </div>

        <div>
            <label>Variant van menu nummer (optioneel)</label>
            <input type="number" name="base_menu_number" class="border rounded p-2 w-full">
            <small>Laat leeg voor een geheel nieuw gerecht.</small>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Opslaan</button>
    </form>
</x-admin-layout>
