<x-admin-layout>
    <h1 class="text-2xl font-bold mb-4">{{ __('admin/menu.manage-menu') }}</h1>

    <div class="flex space-x-4 mb-6">
        <a href="{{ route('admin.menu.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            {{ __('admin/menu.create') }}
        </a>
        <a href="{{ route('admin.categories.index') }}" class="bg-green-600 text-white px-4 py-2 rounded">
            {{ __('admin/categories.manage-categories') }}
        </a>
    </div>

    @foreach($dishTypes as $dishType)
        <h2 class="text-xl font-semibold mt-6">{{ $dishType->name }}</h2>
        <table class="w-full border mt-2 table-fixed">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 w-1/5">{{ __('admin/menu.number') }}</th>
                    <th class="p-2 w-1/5">{{ __('admin/menu.name') }}</th>
                    <th class="p-2 w-1/5">{{ __('admin/menu.description') }}</th>
                    <th class="p-2 w-1/5">{{ __('admin/menu.price') }}</th>
                    <th class="p-2 w-1/5">{{ __('admin/menu.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dishType->menuItems as $item)
                    <tr class="border-b">
                        <td class="p-2">{{ $item->menu_number }}{{ $item->menu_suffix }}</td>
                        <td class="p-2">{{ $item->name }}</td>
                        <td class="p-2 truncate">{{ $item->description }}</td>
                        <td class="p-2">€{{ number_format($item->price, 2, ',', '.') }}</td>
                        <td class="p-2">
                            <a href="{{ route('admin.menu.edit', $item) }}" class="text-blue-600">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <form action="{{ route('admin.menu.destroy', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 ml-2">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-2">{{ __('admin/menu.no-dishes') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endforeach
</x-admin-layout>
