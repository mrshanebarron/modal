# Laravel Design Modal

Flexible modal and slideover dialog component for Laravel. Supports Livewire, Blade, and Vue 3.

## Installation

```bash
composer require mrshanebarron/modal
```

For Vue components:
```bash
npm install @laraveldesign/modal
```

## Usage

### Livewire Component

```blade
<livewire:ld-modal title="Confirm Action">
    <p>Are you sure you want to proceed?</p>

    <x-slot name="footer">
        <button wire:click="$dispatch('closeModal')">Cancel</button>
        <button wire:click="confirm">Confirm</button>
    </x-slot>
</livewire:ld-modal>

{{-- With options --}}
<livewire:ld-modal
    title="Edit Profile"
    size="lg"
    type="slideover"
    :close-on-escape="true"
    :close-on-backdrop="false"
    :show-close-button="true"
/>
```

### Opening/Closing via Events

```php
// In your Livewire component
$this->dispatch('openModal');
$this->dispatch('closeModal');
```

### Blade Component

```blade
<x-ld-modal name="confirm-modal" title="Confirmation">
    <p>Are you sure?</p>

    <x-slot name="footer">
        <button @click="$dispatch('close-modal', 'confirm-modal')">Cancel</button>
        <button @click="confirmAction">Yes, Continue</button>
    </x-slot>
</x-ld-modal>

{{-- Trigger --}}
<button @click="$dispatch('open-modal', 'confirm-modal')">
    Open Modal
</button>
```

### Vue 3 Component

```vue
<script setup>
import { ref } from 'vue'
import { LdModal } from '@laraveldesign/modal'

const showModal = ref(false)
</script>

<template>
  <button @click="showModal = true">Open Modal</button>

  <LdModal v-model:show="showModal" title="Edit User" size="lg">
    <form @submit.prevent="save">
      <input v-model="name" placeholder="Name" />
    </form>

    <template #footer>
      <button @click="showModal = false">Cancel</button>
      <button @click="save">Save</button>
    </template>
  </LdModal>
</template>
```

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `show` | boolean | `false` | Control modal visibility |
| `title` | string | `''` | Modal title |
| `size` | string | `'md'` | Modal size: `sm`, `md`, `lg`, `xl`, `2xl`, `full` |
| `type` | string | `'modal'` | Display type: `modal`, `slideover` |
| `closeOnEscape` | boolean | `true` | Close when Escape key is pressed |
| `closeOnBackdrop` | boolean | `true` | Close when clicking outside |
| `showCloseButton` | boolean | `true` | Show X close button |

## Events

### Livewire Events

```php
// Listen in your component
protected $listeners = ['modal-opened', 'modal-closed'];

public function onModalOpened()
{
    // Modal was opened
}
```

### JavaScript Events

```javascript
Livewire.on('modal-opened', () => {
    console.log('Modal opened');
});

Livewire.on('modal-closed', () => {
    console.log('Modal closed');
});
```

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=ld-modal-config
```

### Custom Sizes

```php
// config/ld-modal.php
'sizes' => [
    'sm' => 'max-w-sm',
    'md' => 'max-w-md',
    'lg' => 'max-w-lg',
    'xl' => 'max-w-xl',
    '2xl' => 'max-w-2xl',
    '3xl' => 'max-w-3xl',
    'full' => 'max-w-full mx-4',
],
```

## Customization

### Publishing Views

```bash
php artisan vendor:publish --tag=ld-modal-views
```

## License

MIT
