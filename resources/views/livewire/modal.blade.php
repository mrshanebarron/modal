@php
    $sizeClass = config('ld-modal.sizes.' . $size, config('ld-modal.sizes.md'));
@endphp

<div>
    @if($show)
        {{-- Overlay --}}
        <div
            class="{{ config('ld-modal.classes.overlay') }}"
            @if($closeOnOverlay) wire:click="close" @endif
            wire:transition.opacity
        ></div>

        {{-- Modal Container --}}
        <div class="{{ config('ld-modal.classes.container') }}">
            <div class="flex min-h-full items-center justify-center p-4">
                {{-- Modal Panel --}}
                <div
                    class="{{ config('ld-modal.classes.panel') }} {{ $sizeClass }} w-full"
                    @if($closeOnEscape)
                        x-data
                        x-on:keydown.escape.window="$wire.close()"
                    @endif
                >
                    {{-- Header --}}
                    @if($title || isset($header))
                        <div class="{{ config('ld-modal.classes.header') }}">
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ $title ?? $header ?? '' }}
                            </h3>
                            <button
                                wire:click="close"
                                class="text-gray-400 hover:text-gray-600 focus:outline-none"
                            >
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    {{-- Body --}}
                    <div class="{{ config('ld-modal.classes.body') }}">
                        {{ $slot }}
                    </div>

                    {{-- Footer --}}
                    @if(isset($footer))
                        <div class="{{ config('ld-modal.classes.footer') }}">
                            {{ $footer }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
