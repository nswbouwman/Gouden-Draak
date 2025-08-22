<x-admin-layout>
    <h1 class="text-2xl font-bold mb-4">Categorieën beheren</h1>

    <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
        + Nieuwe categorie
    </a>

    <table class="w-full border">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">Naam</th>
                <th class="p-2">Acties</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr class="border-b">
                    <td class="p-2">{{ $category->name }}</td>
                    <td class="p-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-600">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 ml-2">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="2" class="p-2">Nog geen categorieën</td></tr>
            @endforelse
        </tbody>
    </table>
</x-admin-layout>
