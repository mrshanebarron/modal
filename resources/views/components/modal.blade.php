<div
    x-data="{ show: @entangle('show').live }"
    x-show="show"
    x-cloak
    @if($closeOnEscape) @keydown.escape.window="show = false" @endif
    class="fixed inset-0 z-50 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
>
    {{-- Backdrop --}}
    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @if($closeOnBackdrop) @click="show = false" @endif
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
    ></div>

    @if($type === 'slideover')
        {{-- Slide-over Panel --}}
        <div class="fixed inset-y-0 right-0 flex max-w-full pl-10">
            <div
                x-show="show"
                x-transition:enter="transform transition ease-in-out duration-300"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition ease-in-out duration-300"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="w-screen {{ $sizeClass }}"
            >
                <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                    <div class="flex items-center justify-between px-4 py-6 sm:px-6 border-b">
                        @if($title)
                            <h2 class="text-lg font-semibold text-gray-900" id="modal-title">{{ $title }}</h2>
                        @endif
                        @if($showCloseButton)
                            <button @click="show = false" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        @endif
                    </div>
                    <div class="relative flex-1 px-4 py-6 sm:px-6">
                        {{ $slot }}
                    </div>
                    @isset($footer)
                        <div class="border-t px-4 py-4 sm:px-6">{{ $footer }}</div>
                    @endisset
                </div>
            </div>
        </div>
    @else
        {{-- Centered Modal --}}
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                x-show="show"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full {{ $sizeClass }}"
            >
                @if($title || $showCloseButton)
                    <div class="flex items-center justify-between px-4 py-4 sm:px-6 border-b">
                        @if($title)
                            <h3 class="text-lg font-semibold text-gray-900" id="modal-title">{{ $title }}</h3>
                        @endif
                        @if($showCloseButton)
                            <button @click="show = false" class="text-gray-400 hover:text-gray-500 ml-auto">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        @endif
                    </div>
                @endif
                <div class="px-4 py-5 sm:p-6">
                    {{ $slot }}
                </div>
                @isset($footer)
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t">
                        {{ $footer }}
                    </div>
                @endisset
            </div>
        </div>
    @endif
</div>
