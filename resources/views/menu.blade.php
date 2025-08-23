<x-app-layout>
    <x-navbar-with-border>
        <div class="p-4 bg-white rounded shadow text-sm font-serif max-w-6xl mx-auto">
            
            <!-- Sorting Controls -->
            <div class="mb-6 flex flex-wrap gap-2">
                <h3 class="text-lg font-bold mr-4 self-center">{{ __('menu.sort-menu') }}</h3>
                <a href="{{ route('menu') }}?sort=default" 
                   class="px-3 py-1 rounded {{ $sortType === 'default' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    {{ __('menu.standard-sort') }}
                </a>
                <a href="{{ route('menu') }}?sort=favorites-number" 
                   class="px-3 py-1 rounded {{ $sortType === 'favorites-number' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    {{ __('menu.favorites-first-number') }}
                </a>
                <a href="{{ route('menu') }}?sort=favorites-alpha" 
                   class="px-3 py-1 rounded {{ $sortType === 'favorites-alpha' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    {{ __('menu.favorites-first-alphabetical') }}
                </a>
            </div>

            @foreach ($groupedItems as $category => $items)
                <div class="mb-8 break-inside-avoid-column">
                    <h2 class="text-xl font-bold border-b border-gray-300 mb-2 {{ $category === 'FAVORITES' ? 'text-yellow-600' : '' }}">
                        {{ $category === 'FAVORITES' ? '★ FAVORIETEN' : strtoupper($category) }}
                    </h2>
                    <ul>
                        @foreach ($items as $item)
                            <li class="flex justify-between items-center py-1 border-b border-dotted border-gray-300 group">
                                <div class="flex items-center flex-1">
                                    <!-- Favorite Star -->
                                    <button 
                                        class="favorite-btn mr-2 text-lg {{ $item->is_favorite ? 'text-yellow-500' : 'text-gray-300 hover:text-yellow-400' }}"
                                        data-item-id="{{ $item->id }}"
                                        title="{{ $item->is_favorite ? __('menu.remove-from-favorites') : __('menu.add-to-favorites') }}">
                                        {{ $item->is_favorite ? '★' : '☆' }}
                                    </button>
                                    
                                    <span class="flex-1">
                                        @if ($item->menu_number)
                                            {{ $item->menu_number }}{{ $item->menu_suffix ? $item->menu_suffix . '.' : '.' }}
                                        @else
                                            @if ($item->menu_suffix)
                                                {{ $item->menu_suffix }}.
                                            @endif
                                        @endif
                                        {!! $item->name !!}
                                        @if ($item->description)
                                            <span class="text-gray-500 italic">({!! $item->description !!})</span>
                                        @endif
                                    </span>
                                </div>
                                <span class="ml-4">€ {{ number_format($item->price, 2, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </x-navbar-with-border>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const favoriteButtons = document.querySelectorAll('.favorite-btn');
        
        favoriteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.dataset.itemId;
                const button = this;
                
                // Disable button during request
                button.style.pointerEvents = 'none';
                
                fetch('{{ route("menu.favorite.toggle") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ item_id: itemId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update button appearance
                        if (data.is_favorite) {
                            button.textContent = '★';
                            button.classList.remove('text-gray-300', 'hover:text-yellow-400');
                            button.classList.add('text-yellow-500');
                            button.title = 'Remove from favorites';
                        } else {
                            button.textContent = '☆';
                            button.classList.remove('text-yellow-500');
                            button.classList.add('text-gray-300', 'hover:text-yellow-400');
                            button.title = 'Add to favorites';
                        }
                        
                        // Show success feedback
                        const originalText = button.textContent;
                        button.classList.add('text-green-500');
                        
                        button.textContent = originalText;
                        button.classList.remove('text-green-500');
                        if (data.is_favorite) {
                            button.classList.add('text-yellow-500');
                        } else {
                            button.classList.add('text-gray-300', 'hover:text-yellow-400');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error toggling favorite:', error);
                    // Show error feedback
                    const originalText = button.textContent;
                    button.textContent = '✗';
                    button.classList.add('text-red-500');
                    
                    button.textContent = originalText;
                    button.classList.remove('text-red-500');
                })
                .finally(() => {
                    button.style.pointerEvents = 'auto';
                });
            });
        });
    });
</script>