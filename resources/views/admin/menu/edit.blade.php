<x-admin-layout>
    <h1 class="text-2xl font-bold mb-4">{{ __('admin/menu.edit') }}</h1>

    <form action="{{ route('admin.menu.update', $menu) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label>{{ __('admin/menu.category') }}</label>
            <select name="dish_type_id" class="border rounded p-2 w-full">
                @foreach($dishTypes as $type)
                    <option value="{{ $type->id }}" @if($menu->dish_type_id == $type->id) selected @endif>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>{{ __('admin/menu.name') }}</label>
            <input type="text" name="name" value="{{ $menu->name }}" class="border rounded p-2 w-full">
        </div>

        <div>
            <label>{{ __('admin/menu.description') }}</label>
            <textarea name="description" class="border rounded p-2 w-full">{{ $menu->description }}</textarea>
        </div>

        <div>
            <label>{{ __('admin/menu.price') }}</label>
            <input type="number" step="0.01" name="price" value="{{ $menu->price }}" class="border rounded p-2 w-full">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">{{ __('admin/menu.save') }}</button>
    </form>
</x-admin-layout>
