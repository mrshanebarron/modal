# Modal

A flexible, accessible modal dialog component for Laravel applications. Features smooth animations, multiple sizes, and customizable behavior. Works with Livewire and Vue 3.

## Installation

```bash
composer require mrshanebarron/modal
```

## Livewire Usage

### Basic Usage

```blade
<button wire:click="$set('showModal', true)">Open Modal</button>

<livewire:sb-modal wire:model="showModal" title="My Modal">
    <p>Modal content goes here.</p>
</livewire:sb-modal>
```

### With Footer Actions

```blade
<livewire:sb-modal wire:model="showModal" title="Confirm Action">
    <p>Are you sure you want to proceed?</p>

    <x-slot name="footer">
        <button wire:click="$set('showModal', false)">Cancel</button>
        <button wire:click="confirm">Confirm</button>
    </x-slot>
</livewire:sb-modal>
```

### Different Sizes

```blade
<livewire:sb-modal wire:model="showSmall" size="sm" title="Small Modal">
    Small modal content.
</livewire:sb-modal>

<livewire:sb-modal wire:model="showLarge" size="xl" title="Large Modal">
    Large modal content.
</livewire:sb-modal>
```

### Livewire Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `wire:model` | boolean | required | Controls modal visibility |
| `title` | string | `null` | Modal header title |
| `size` | string | `'md'` | Size: `sm`, `md`, `lg`, `xl`, `2xl`, `full` |
| `close-on-escape` | boolean | `true` | Close when Escape pressed |
| `close-on-overlay` | boolean | `true` | Close when clicking overlay |

## Vue 3 Usage

### Setup

```javascript
import { SbModal } from './vendor/sb-modal';
app.component('SbModal', SbModal);
```

### Basic Usage

```vue
<template>
  <button @click="showModal = true">Open Modal</button>

  <SbModal v-model="showModal" title="My Modal">
    <p>Modal content goes here.</p>
  </SbModal>
</template>

<script setup>
import { ref } from 'vue';
const showModal = ref(false);
</script>
```

### With Header and Footer Slots

```vue
<template>
  <SbModal v-model="showModal">
    <template #header>
      <div class="flex items-center gap-2">
        <span class="text-red-500">Warning</span>
        Custom Header
      </div>
    </template>

    <p>Are you sure you want to delete this item?</p>

    <template #footer>
      <SbButton variant="secondary" @click="showModal = false">
        Cancel
      </SbButton>
      <SbButton variant="danger" @click="deleteItem">
        Delete
      </SbButton>
    </template>
  </SbModal>
</template>
```

### Sizes

```vue
<template>
  <SbModal v-model="show" size="sm" title="Small">...</SbModal>
  <SbModal v-model="show" size="md" title="Medium">...</SbModal>
  <SbModal v-model="show" size="lg" title="Large">...</SbModal>
  <SbModal v-model="show" size="xl" title="Extra Large">...</SbModal>
  <SbModal v-model="show" size="2xl" title="2XL">...</SbModal>
  <SbModal v-model="show" size="full" title="Full Width">...</SbModal>
</template>
```

### Prevent Closing

```vue
<template>
  <!-- Don't close on escape or overlay click -->
  <SbModal
    v-model="showModal"
    title="Important Form"
    :close-on-escape="false"
    :close-on-overlay="false"
  >
    <p>Fill out this form before closing.</p>
  </SbModal>
</template>
```

### Vue Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `modelValue` | Boolean | `false` | Controls visibility (v-model) |
| `title` | String | `null` | Header title text |
| `size` | String | `'md'` | Modal width: `sm`, `md`, `lg`, `xl`, `2xl`, `full` |
| `closeOnEscape` | Boolean | `true` | Close on Escape key |
| `closeOnOverlay` | Boolean | `true` | Close on backdrop click |

### Events

| Event | Description |
|-------|-------------|
| `update:modelValue` | Emitted when visibility changes |
| `close` | Emitted when modal closes |

### Slots

| Slot | Description |
|------|-------------|
| default | Modal body content |
| `header` | Custom header content |
| `footer` | Footer content (buttons, etc.) |

## Features

- **Teleport**: Modal renders at document body level
- **Body Scroll Lock**: Prevents background scrolling when open
- **Focus Management**: Focuses modal on open
- **Animations**: Smooth fade transitions
- **Accessibility**: Proper ARIA attributes and keyboard handling

## Styling

Default styling uses Tailwind CSS:
- White background with rounded corners
- Gray border separators for header/footer
- Semi-transparent black overlay
- Centered positioning with padding

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
- Tailwind CSS 3.x

## License

MIT License
