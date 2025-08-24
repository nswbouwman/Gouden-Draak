<x-admin-layout>
    <h1 class="text-2xl font-bold mb-4">{{ __('admin/dashboard.welcome') }}</h1>
    <ul class="list-disc ml-6">
        <li><a href="{{ route('admin.menu.index') }}" class="text-blue-700 underline">{{ __('admin/menu.manage-menu') }}</a></li>
        <li><a href="{{ route('admin.sales.index') }}" class="text-blue-700 underline">{{ __('admin/sales.title') }}</a></li>
    </ul>
</x-admin-layout>
