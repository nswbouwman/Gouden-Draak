<x-admin-layout>
    <h1 class="text-2xl font-bold mb-4">{{ __('admin/sales.title') }}</h1>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">{{ __('admin/sales.file') }}</th>
                <th class="p-2">{{ __('admin/sales.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($files as $file)
                <tr class="border-b">
                    <td class="p-2">{{ basename($file) }}</td>
                    <td class="p-2">
                        <a href="{{ route('admin.sales.download', basename($file)) }}"
                           class="text-blue-600 underline">{{ __('admin/sales.download') }}</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="2" class="p-2">{{ __('admin/sales.empty') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</x-admin-layout>
