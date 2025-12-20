@php
$sizeStyles = [
    'sm' => 'max-width: 24rem;',
    'md' => 'max-width: 28rem;',
    'lg' => 'max-width: 32rem;',
    'xl' => 'max-width: 36rem;',
    '2xl' => 'max-width: 42rem;',
];
$modalSize = $sizeStyles[$size] ?? $sizeStyles['md'];
@endphp

<div>
    @if($show)
        {{-- Overlay --}}
        <div
            style="position: fixed; inset: 0; background-color: rgba(0, 0, 0, 0.5); z-index: 40;"
            @if($closeOnOverlay) wire:click="close" @endif
        ></div>

        {{-- Modal Container --}}
        <div style="position: fixed; inset: 0; z-index: 50; overflow-y: auto;">
            <div style="display: flex; min-height: 100%; align-items: center; justify-content: center; padding: 1rem;">
                {{-- Modal Panel --}}
                <div
                    style="background-color: white; border-radius: 0.75rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); width: 100%; {{ $modalSize }}"
                    x-data
                    @if($closeOnEscape)
                        x-on:keydown.escape.window="$wire.close()"
                    @endif
                >
                    {{-- Header --}}
                    @if($title)
                        <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb;">
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: #111827; margin: 0;">
                                {{ $title }}
                            </h3>
                            <button
                                wire:click="close"
                                style="color: #9ca3af; background: none; border: none; cursor: pointer; padding: 0.25rem;"
                                onmouseover="this.style.color='#4b5563'"
                                onmouseout="this.style.color='#9ca3af'"
                            >
                                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    {{-- Body --}}
                    <div style="padding: 1.5rem;">
                        @if($content)
                            {!! $content !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
