<x-admin-layout>
<div class="p-4 bg-white rounded shadow text-sm font-serif max-w-6xl mx-auto">
    @foreach($menuItems as $category => $items)
        <div class="mb-8 break-inside-avoid-column">
            <h2 class="text-xl font-bold border-b border-gray-300 mb-2">{{ strtoupper($category) }}</h2>
            <ul>
                @foreach($items as $item)
                    <li class="flex justify-between py-1 border-b border-dotted border-gray-300">
                        <span>
                            @if ($item->menu_number)
                                {{ $item->menu_number }}{{ $item->menu_suffix ? $item->menu_suffix . '.' : '.' }}
                            @else
                                @if ($item->menu_suffix)
                                    {{ $item->menu_suffix }}.
                                @endif
                            @endif
                            {!! $item->name !!}
                            @if($item->description)
                                <span class="text-gray-500 italic">({!! $item->description !!})</span>
                            @endif
                        </span>
                        <span>€ {{ number_format($item->price, 2, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
</x-admin-layout>
