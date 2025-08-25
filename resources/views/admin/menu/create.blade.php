<x-admin-layout>
    <h1 class="text-2xl font-bold mb-4">{{ __('admin/menu.create') }}</h1>

    <form action="{{ route('admin.menu.store') }}" method="POST" class="space-y-6 max-w-2xl">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin/menu.category') }}</label>
            <select name="dish_type_id" class="border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @foreach($dishTypes as $type)
                    <option value="{{ $type->id }}" {{ old('dish_type_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('dish_type_id')" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin/menu.name') }}</label>
            <input type="text" name="name" value="{{ old('name') }}" 
                   class="border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin/menu.description') }}</label>
            <textarea name="description" rows="3" 
                      class="border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
            <x-input-error :messages="$errors->get('description')" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin/menu.price') }}</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" 
                   class="border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <x-input-error :messages="$errors->get('price')" />
        </div>

        <div class="border-t pt-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('admin/menu.numbering') }}</h3>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="no_numbering" value="1" 
                           {{ old('no_numbering') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                           onchange="toggleNumbering()">
                    <span class="ml-2 text-sm text-gray-700">{{ __('admin/menu.no_numbering') }}</span>
                </label>
            </div>

            <div id="numbering-options" class="{{ old('no_numbering') ? 'hidden' : '' }}">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('admin/menu.base_menu_number') }}
                    </label>
                    <input type="number" name="base_menu_number" value="{{ old('base_menu_number') }}" 
                           class="border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <small class="text-gray-600 text-sm mt-1 block">
                        {{ __('admin/menu.base_menu_number_help') }} 
                        {{ __('admin/menu.base_menu_number_help_text') }}
                    </small>
                    <x-input-error :messages="$errors->get('base_menu_number')" />
                </div>
            </div>
        </div>

        <div class="border-t pt-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('admin/menu.offer') }}</h3>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="is_offer" value="1" 
                           {{ old('is_offer') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                           onchange="toggleOfferPrice()">
                    <span class="ml-2 text-sm text-gray-700">{{ __('offers.week-offer') }}</span>
                </label>
            </div>

            <div id="offer-price" class="{{ old('is_offer') ? '' : 'hidden' }}">
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('offers.offer-price') }}</label>
                <input type="number" step="0.01" name="offer_price" value="{{ old('offer_price') }}" 
                       class="border border-gray-300 rounded-md p-2 w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <x-input-error :messages="$errors->get('offer_price')" />
            </div>
        </div>

        <div class="flex space-x-4 pt-6">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md shadow">
                {{ __('admin/menu.save') }}
            </button>
            <a href="{{ route('admin.menu.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md shadow">
                {{ __('admin/menu.cancel') }}
            </a>
        </div>
    </form>

    <script>
        function toggleNumbering() {
            const checkbox = document.querySelector('input[name="no_numbering"]');
            const options = document.getElementById('numbering-options');
            
            if (checkbox.checked) {
                options.classList.add('hidden');
            } else {
                options.classList.remove('hidden');
            }
        }

        function toggleOfferPrice() {
            const checkbox = document.querySelector('input[name="is_offer"]');
            const priceField = document.getElementById('offer-price');
            
            if (checkbox.checked) {
                priceField.classList.remove('hidden');
            } else {
                priceField.classList.add('hidden');
            }
        }
    </script>
</x-admin-layout>