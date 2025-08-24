<x-admin-layout>
    <h1 class="text-2xl font-bold mb-4">{{ __('admin/menu.create') }}</h1>

    <form action="{{ route('admin.menu.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label>{{ __('admin/menu.category') }}</label>
            <select name="dish_type_id" class="border rounded p-2 w-full">
                @foreach($dishTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>{{ __('admin/menu.name') }}</label>
            <input type="text" name="name" class="border rounded p-2 w-full">
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <label>{{ __('admin/menu.description') }}</label>
            <textarea name="description" class="border rounded p-2 w-full"></textarea>
        </div>

        <div>
            <label>{{ __('admin/menu.price') }}</label>
            <input type="number" step="0.01" name="price" class="border rounded p-2 w-full">
            <x-input-error :messages="$errors->get('price')" />
        </div>

        <div>
            <label>{{ __('admin/menu.base_menu_number') }}</label>
            <input type="number" name="base_menu_number" class="border rounded p-2 w-full">
            <small>{{ __('admin/menu.base_menu_number_help') }}</small>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">{{ __('admin/menu.save') }}</button>
    </form>
</x-admin-layout>
