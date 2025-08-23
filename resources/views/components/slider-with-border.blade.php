<table class="p-1 w-full border-collapse">
    <tr class="h-12 bg-red-600">
        <td class="text-center w-3/10 text-yellow-400 text-3xl">
            <img class="align-middle inline h-12" src="{{ asset('images/dragon-small.png') }}" alt="{{ __('navbar.image-gouden-draak') }}">
            <span class="font-chinese">De Gouden Draak</span>
            <img class="align-middle inline h-12" src="{{ asset('images/dragon-small-flipped.png') }}" alt="{{ __('navbar.image-gouden-draak') }}">
        </td>
        <td class="overflow-hidden">
            <a href="paginas/aanbiedingen.html" class="text-yellow-400 font-bold no-underline">
                <div class="max-w-xs mx-auto marquee font-serif font-bold">
                    Welkom bij De Gouden Draak. Klik op deze tekst om de aanbiedingen van deze week te zien!
                </div>
            </a>
        </td>
        <td class="text-center w-3/10 text-yellow-400 text-3xl">
            <img class="align-middle inline h-12" src="{{ asset('images/dragon-small.png') }}" alt="{{ __('navbar.image-gouden-draak') }}">
            <span class="font-chinese">De Gouden Draak</span>
            <img class="align-middle inline h-12" src="{{ asset('images/dragon-small-flipped.png') }}"
                alt="{{ __('navbar.image-gouden-draak') }}">
        </td>
    </tr>
</table>

<table class="p-1 w-full border-collapse">
    <tr class="h-2 bg-red-600">
        <td colspan="9"></td>
    </tr>

    <tr class="h-6 bg-red-600">
        <td class="w-2"></td>
        <td class="w-6 border-l-4 border-t-4 border-yellow-400"></td>
        <td class="w-6 border-r-4 border-t-4 border-yellow-400"></td>
        <td class="w-6 border-r-4 border-b-4 border-yellow-400"></td>
        <td class="border-t-4 border-b-4 border-yellow-400"></td>
        <td class="w-6 border-l-4 border-b-4 border-yellow-400"></td>
        <td class="w-6 border-l-4 border-t-4 border-yellow-400"></td>
        <td class="w-6 border-r-4 border-t-4 border-yellow-400"></td>
        <td class="w-2"></td>
    </tr>

    <tr class="h-6 bg-red-600">
        <td class="w-2"></td>
        <td class="w-6 border-l-4 border-b-4 border-yellow-400"></td>
        <td class="w-6 border-4 border-yellow-400"></td>
        <td class="w-6 border-4 border-yellow-400"></td>
        <td></td>
        <td class="w-6 border-4 border-yellow-400"></td>
        <td class="w-6 border-4 border-yellow-400"></td>
        <td class="w-6 border-r-4 border-b-4 border-yellow-400"></td>
        <td class="w-2"></td>
    </tr>

    <tr class="h-6 bg-red-600">
        <td class="w-2"></td>
        <td class="w-6 border-r-4 border-b-4 border-yellow-400"></td>
        <td class="w-6 border-4 border-yellow-400"></td>
        <td class="w-6"></td>
        <td></td>
        <td class="w-6"></td>
        <td class="w-6 border-4 border-yellow-400"></td>
        <td class="w-6 border-b-4 border-yellow-400"></td>
        <td class="w-2"></td>
    </tr>

    <tr class="h-12 bg-red-600">
        <td class="w-2"></td>
        <td class="w-6 border-r-4 border-l-4 border-yellow-400"></td>
        <td class="w-6"></td>
        <td class="w-6"></td>
        <td class="text-center">
            <table class="w-full">
                <tr class="pt-12">
                    <td colspan="3" class="h-12"></td>
                </tr>
                <tr class="pt-12">
                    <td class="w-12"></td>
                    <td class="text-center text-xs border border-black bg-floralwhite p-4">
                        {{ $slot }}
                    </td>
                    <td class="w-12"></td>
                </tr>
            </table>
            <br>
            <div class="text-center"><a href="{{ route('contact') }}" class="text-yellow-400 no-underline">Naar
                    Contact</a></div>
        </td>
        <td class="w-6"></td>
        <td class="w-6"></td>
        <td class="w-6 border-r-4 border-l-4 border-yellow-400"></td>
        <td class="w-2"></td>
    </tr>

    <tr class="h-6 bg-red-600">
        <td class="w-2"></td>
        <td class="w-6 border-r-4 border-t-4 border-yellow-400"></td>
        <td class="w-6 border-4 border-yellow-400"></td>
        <td class="w-6"></td>
        <td></td>
        <td class="w-6"></td>
        <td class="w-6 border-4 border-yellow-400"></td>
        <td class="w-6 border-t-4 border-yellow-400"></td>
        <td class="w-2"></td>
    </tr>

    <tr class="h-6 bg-red-600">
        <td class="w-2"></td>
        <td class="w-6 border-l-4 border-t-4 border-yellow-400"></td>
        <td class="w-6 border-4 border-yellow-400"></td>
        <td class="w-6 border-4 border-yellow-400"></td>
        <td></td>
        <td class="w-6 border-4 border-yellow-400"></td>
        <td class="w-6 border-4 border-yellow-400"></td>
        <td class="w-6 border-r-4 border-t-4 border-yellow-400"></td>
        <td class="w-2"></td>
    </tr>

    <tr class="h-6 bg-red-600">
        <td class="w-2"></td>
        <td class="w-6 border-l-4 border-b-4 border-yellow-400"></td>
        <td class="w-6 border-r-4 border-b-4 border-yellow-400"></td>
        <td class="w-6 border-r-4 border-yellow-400"></td>
        <td class="border-t-4 border-b-4 border-yellow-400"></td>
        <td class="w-6 border-l-4 border-yellow-400"></td>
        <td class="w-6 border-l-4 border-b-4 border-yellow-400"></td>
        <td class="w-6 border-r-4 border-b-4 border-yellow-400"></td>
        <td class="w-2"></td>
    </tr>

    <tr class="h-2 bg-red-600">
        <td colspan="9"></td>
    </tr>
</table>
