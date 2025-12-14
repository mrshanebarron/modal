<?php

namespace MrShaneBarron\Modal\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Modal extends Component
{
    public bool $show = false;
    public string $size = 'md';
    public string $title = '';
    public bool $closeOnEscape = true;
    public bool $closeOnBackdrop = true;
    public bool $showCloseButton = true;
    public string $type = 'modal'; // modal, slideover

    protected $listeners = ['openModal' => 'open', 'closeModal' => 'close'];

    public function mount(
        bool $show = false,
        string $size = 'md',
        string $title = '',
        bool $closeOnEscape = true,
        bool $closeOnBackdrop = true,
        bool $showCloseButton = true,
        string $type = 'modal'
    ): void {
        $this->show = $show;
        $this->size = $size;
        $this->title = $title;
        $this->closeOnEscape = $closeOnEscape;
        $this->closeOnBackdrop = $closeOnBackdrop;
        $this->showCloseButton = $showCloseButton;
        $this->type = $type;
    }

    public function open(): void
    {
        $this->show = true;
        $this->dispatch('modal-opened');
    }

    public function close(): void
    {
        $this->show = false;
        $this->dispatch('modal-closed');
    }

    public function render(): View
    {
        return view('ld-modal::components.modal', [
            'sizeClass' => config("ld-modal.sizes.{$this->size}", 'max-w-md'),
        ]);
    }
}
