<?php

namespace MrShaneBarron\Modal\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public string $sizeClass;

    public function __construct(
        public bool $show = false,
        public string $size = 'md',
        public string $title = '',
        public bool $closeOnEscape = true,
        public bool $closeOnBackdrop = true,
        public bool $showCloseButton = true,
        public string $type = 'modal'
    ) {
        $this->sizeClass = config("ld-modal.sizes.{$size}", 'max-w-md');
    }

    public function render(): View
    {
        return view('ld-modal::components.modal');
    }
}
