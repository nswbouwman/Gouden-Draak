<div class="border-b-4 border-blue-600 flex items-center justify-between px-6 py-4 bg-blue-50">
    <div class="flex-shrink-0">
        <img src="{{ asset('images/goodpay.png') }}" alt="Goodpay Logo" class="h-20">
    </div>

    <div class="flex items-center space-x-6">
        <a href="{{ route('cashdesk.index') }}">
            <div class="px-6 py-2 bg-blue-100 text-blue-700 font-bold rounded-lg border border-blue-500 hover:bg-blue-200 transition">
                {{ __('cashdesk/navbar.cashdesk') }}
            </div>
        </a>

        <a href="{{ route('cashdesk.menu') }}">
            <div class="px-6 py-2 bg-blue-100 text-blue-700 font-bold rounded-lg border border-blue-500 hover:bg-blue-200 transition">
                {{ __('cashdesk/navbar.dishes') }}
            </div>
        </a>

        <a href="{{ route('sales.index') }}">
            <div class="px-6 py-2 bg-blue-100 text-blue-700 font-bold rounded-lg border border-blue-500 hover:bg-blue-200 transition">
               {{ __('cashdesk/navbar.sales-overview') }}
            </div>
        </a>

        <a href="{{ route('logout') }}" class="ml-12">
            <div class="px-6 py-2 bg-blue-100 text-blue-700 font-bold rounded-lg border border-blue-500 hover:bg-blue-200 transition">
                {{ __('cashdesk/navbar.logout') }}
            </div>
        </a>
    </div>
</div>
