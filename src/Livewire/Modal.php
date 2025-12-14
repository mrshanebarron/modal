<?php

namespace MrShaneBarron\Modal\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public bool $show = false;
    public string $size = 'md';
    public bool $closeOnEscape = true;
    public bool $closeOnOverlay = true;
    public ?string $title = null;

    protected $listeners = ['openModal' => 'open', 'closeModal' => 'close'];

    public function mount(
        bool $show = false,
        string $size = 'md',
        bool $closeOnEscape = true,
        bool $closeOnOverlay = true,
        ?string $title = null
    ): void {
        $this->show = $show;
        $this->size = $size;
        $this->closeOnEscape = $closeOnEscape;
        $this->closeOnOverlay = $closeOnOverlay;
        $this->title = $title;
    }

    public function open(): void
    {
        $this->show = true;
    }

    public function close(): void
    {
        $this->show = false;
    }

    public function toggle(): void
    {
        $this->show = !$this->show;
    }

    public function render()
    {
        return view('ld-modal::livewire.modal');
    }
}
