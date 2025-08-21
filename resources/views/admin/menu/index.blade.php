<x-admin-layout>
    <h1 class="text-2xl font-bold mb-4">Menu beheren</h1>

    <a href="{{ route('admin.menu.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Nieuw gerecht</a>

    @foreach($dishTypes as $dishType)
        <h2 class="text-xl font-semibold mt-6">{{ $dishType->name }}</h2>
        <table class="w-full border mt-2">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">Nr</th>
                    <th class="p-2">Naam</th>
                    <th class="p-2">Prijs</th>
                    <th class="p-2">Acties</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dishType->menuItems as $item)
                    <tr class="border-b">
                        <td class="p-2">{{ $item->menu_number }}{{ $item->menu_suffix }}</td>
                        <td class="p-2">{{ $item->name }}</td>
                        <td class="p-2">€{{ number_format($item->price, 2, ',', '.') }}</td>
                        <td class="p-2">
                            <a href="{{ route('admin.menu.edit', $item) }}" class="text-blue-600">Bewerken</a>
                            <form action="{{ route('admin.menu.destroy', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 ml-2">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-2">Nog geen gerechten</td></tr>
                @endforelse
            </tbody>
        </table>
    @endforeach
</x-admin-layout>
