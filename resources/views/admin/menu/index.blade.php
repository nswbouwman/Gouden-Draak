<x-admin-layout>
    <h1 class="text-2xl font-bold mb-4">{{ __('admin/menu.manage-menu') }}</h1>

    <div class="flex space-x-4 mb-6">
        <a href="{{ route('admin.menu.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            {{ __('admin/menu.create') }}
        </a>
        <a href="{{ route('admin.categories.index') }}" 
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
            {{ __('admin/categories.manage-categories') }}
        </a>
    </div>

    @foreach($dishTypes as $dishType)
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-3">{{ $dishType->name }}</h2>

            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="w-full border border-gray-200 text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="p-3 w-1/12">{{ __('admin/menu.number') }}</th>
                            <th class="p-3 w-3/12">{{ __('admin/menu.name') }}</th>
                            <th class="p-3 w-5/12">{{ __('admin/menu.description') }}</th>
                            <th class="p-3 w-2/12">{{ __('admin/menu.price') }}</th>
                            <th class="p-3 w-1/12 text-center">{{ __('admin/menu.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dishType->menuItems as $item)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-3">{{ $item->menu_number }}{{ $item->menu_suffix }}</td>
                                <td class="p-3 font-medium text-gray-900">{{ $item->name }}</td>
                                <td class="p-3 text-gray-700 truncate">{{ $item->description }}</td>
                                <td class="p-3">€{{ number_format($item->price, 2, ',', '.') }}</td>
                                <td class="p-3 text-center">
                                    <a href="{{ route('admin.menu.edit', $item) }}" 
                                       class="text-blue-600 hover:text-blue-800">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.menu.destroy', $item) }}" 
                                          method="POST" 
                                          class="inline-block ml-2"
                                          onsubmit="return confirm('{{ __('admin/menu.confirm-delete') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-3 text-center text-gray-500">
                                    {{ __('admin/menu.no-dishes') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</x-admin-layout>
