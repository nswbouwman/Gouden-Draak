<x-admin-layout>
    <h1 class="text-2xl font-bold mb-4">{{ __('admin/categories.add') }}</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-semibold">{{ __('admin/categories.name') }}</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="border rounded p-2 w-full @error('name') border-red-500 @enderror">

            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
            {{ __('admin/categories.save') }}
        </button>
        <a href="{{ route('admin.categories.index') }}" class="ml-2 text-gray-600">{{ __('admin/categories.cancel') }}</a>
    </form>
</x-admin-layout>
