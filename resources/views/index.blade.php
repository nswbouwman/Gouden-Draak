<x-app-layout>
    <x-navbar-with-border>
        <h3 class="text-base mb-4 font-serif font-bold">{{ __('index.introduction') }}<br>
        {{ __('index.introduction2') }}</h3>
        <h2 class="text-xl underline mb-2 font-serif font-bold">{{ __('index.student_offer') }}</h2>
        <h1 class="text-2xl mb-4 font-serif font-bold">{{ __('index.rice_table') }}</h1>
        <h3 class="text-base mb-4 font-serif font-bold">
            {{ __('index.choice') }}<br><br>
            <table class="w-3/5 mx-auto">
                <tr>
                    <td class="w-2/5 text-right">{{ __('index.koe_loe_yuk') }}</td>
                    <td class="w-1/5"></td>
                    <td class="w-2/5 text-left">{{ __('index.foe_yong_hai') }}</td>
                </tr>
                <tr>
                    <td class="text-right">{{ __('index.tjap_tjoy') }}</td>
                    <td></td>
                    <td class="w-2/5 text-left">{{ __('index.shrimp_garlic') }}</td>
                </tr>
                <tr>
                    <td class="text-right">{{ __('index.babi_pangang') }}</td>
                    <td></td>
                    <td class="w-2/5 text-left">{{ __('index.chicken_black_bean') }}</td>
                </tr>
            </table>
            <br>
            {{ __('index.with_white_rice') }}
        </h3>
        <h1 class="text-2xl font-serif font-bold">{{ __('index.price') }} €21,00</h1>
    </x-navbar-with-border>
</x-app-layout>