@if (session()->has('alert'))
    @php
        $alert = session('alert');
        $colors = [
            'success' => 'bg-green-500 text-white',
            'error' => 'bg-red-500 text-white',
            'info' => 'bg-blue-500 text-white',
        ];
        $icons = [
            'success' => 'check_circle',
            'error' => 'error',
            'info' => 'info',
        ];
    @endphp
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed top-5 right-5 z-50">

        <div class="flex items-center gap-3 max-w-sm rounded-lg p-4 shadow-md {{ $colors[$alert['type']] }}">
            <span class="material-symbols-outlined">{{ $icons[$alert['type']] }}</span>
            <span class="flex-1">{{ $alert['message'] }}</span>
            <button @click="show = false" class="ml-2 focus:outline-none">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
    </div>
@endif
