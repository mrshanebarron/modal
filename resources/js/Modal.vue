<template>
  <Teleport to="body">
    <Transition name="modal">
      <div v-if="modelValue" class="fixed inset-0 z-50 overflow-y-auto">
        <!-- Overlay -->
        <div
          class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"
          @click="closeOnOverlay && close()"
        ></div>

        <!-- Modal Container -->
        <div class="flex min-h-full items-center justify-center p-4">
          <!-- Modal Panel -->
          <div
            ref="panelRef"
            :class="['relative bg-white rounded-lg shadow-xl transform transition-all w-full', sizeClass]"
            @keydown.escape="closeOnEscape && close()"
            tabindex="-1"
          >
            <!-- Header -->
            <div v-if="title || $slots.header" class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
              <h3 class="text-lg font-semibold text-gray-900">
                <slot name="header">{{ title }}</slot>
              </h3>
              <button
                @click="close"
                class="text-gray-400 hover:text-gray-600 focus:outline-none"
              >
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>

            <!-- Body -->
            <div class="px-6 py-4">
              <slot></slot>
            </div>

            <!-- Footer -->
            <div v-if="$slots.footer" class="flex items-center justify-end gap-3 px-6 py-4 border-t border-gray-200">
              <slot name="footer"></slot>
            </div>
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<script>
import { ref, computed, watch, onMounted, onUnmounted } from 'vue';

export default {
  name: 'SbModal',
  props: {
    modelValue: { type: Boolean, default: false },
    size: { type: String, default: 'md' },
    closeOnEscape: { type: Boolean, default: true },
    closeOnOverlay: { type: Boolean, default: true },
    title: { type: String, default: null }
  },
  emits: ['update:modelValue', 'close'],
  setup(props, { emit }) {
    const panelRef = ref(null);

    const sizes = {
      sm: 'max-w-sm',
      md: 'max-w-md',
      lg: 'max-w-lg',
      xl: 'max-w-xl',
      '2xl': 'max-w-2xl',
      full: 'max-w-full mx-4'
    };

    const sizeClass = computed(() => sizes[props.size] || sizes.md);

    const close = () => {
      emit('update:modelValue', false);
      emit('close');
    };

    const handleEscape = (e) => {
      if (e.key === 'Escape' && props.closeOnEscape && props.modelValue) {
        close();
      }
    };

    watch(() => props.modelValue, (val) => {
      if (val) {
        document.body.style.overflow = 'hidden';
        setTimeout(() => panelRef.value?.focus(), 0);
      } else {
        document.body.style.overflow = '';
      }
    });

    onMounted(() => {
      document.addEventListener('keydown', handleEscape);
    });

    onUnmounted(() => {
      document.removeEventListener('keydown', handleEscape);
      document.body.style.overflow = '';
    });

    return { panelRef, sizeClass, close };
  }
};
</script>

<style scoped>
.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.2s ease;
}
.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}
</style>
