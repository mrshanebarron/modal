<script setup lang="ts">
import { ref, watch, onMounted, onUnmounted } from 'vue'

interface Props {
  modelValue?: boolean
  size?: 'sm' | 'md' | 'lg' | 'xl' | '2xl' | 'full'
  title?: string
  closeOnEscape?: boolean
  closeOnBackdrop?: boolean
  showCloseButton?: boolean
  type?: 'modal' | 'slideover'
}

const props = withDefaults(defineProps<Props>(), {
  modelValue: false,
  size: 'md',
  title: '',
  closeOnEscape: true,
  closeOnBackdrop: true,
  showCloseButton: true,
  type: 'modal',
})

const emit = defineEmits<{
  (e: 'update:modelValue', value: boolean): void
  (e: 'open'): void
  (e: 'close'): void
}>()

const show = ref(props.modelValue)

watch(() => props.modelValue, (val) => { show.value = val })
watch(show, (val) => {
  emit('update:modelValue', val)
  emit(val ? 'open' : 'close')
})

const sizeClasses: Record<string, string> = {
  sm: 'max-w-sm',
  md: 'max-w-md',
  lg: 'max-w-lg',
  xl: 'max-w-xl',
  '2xl': 'max-w-2xl',
  full: 'max-w-full mx-4',
}

function close() {
  show.value = false
}

function handleEscape(e: KeyboardEvent) {
  if (props.closeOnEscape && e.key === 'Escape' && show.value) close()
}

onMounted(() => document.addEventListener('keydown', handleEscape))
onUnmounted(() => document.removeEventListener('keydown', handleEscape))
</script>

<template>
  <Teleport to="body">
    <div v-show="show" class="fixed inset-0 z-50 overflow-y-auto">
      <Transition
        enter-active-class="ease-out duration-300"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="ease-in duration-200"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <div
          v-show="show"
          @click="closeOnBackdrop && close()"
          class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        />
      </Transition>

      <div v-if="type === 'modal'" class="flex min-h-full items-center justify-center p-4">
        <Transition
          enter-active-class="ease-out duration-300"
          enter-from-class="opacity-0 translate-y-4 scale-95"
          enter-to-class="opacity-100 translate-y-0 scale-100"
          leave-active-class="ease-in duration-200"
          leave-from-class="opacity-100 translate-y-0 scale-100"
          leave-to-class="opacity-0 translate-y-4 scale-95"
        >
          <div v-show="show" :class="['relative bg-white rounded-lg shadow-xl w-full', sizeClasses[size]]">
            <div v-if="title || showCloseButton" class="flex items-center justify-between px-6 py-4 border-b">
              <h3 v-if="title" class="text-lg font-semibold">{{ title }}</h3>
              <button v-if="showCloseButton" @click="close" class="text-gray-400 hover:text-gray-500 ml-auto">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
              </button>
            </div>
            <div class="px-6 py-4"><slot /></div>
            <div v-if="$slots.footer" class="px-6 py-4 bg-gray-50 border-t"><slot name="footer" /></div>
          </div>
        </Transition>
      </div>

      <div v-else class="fixed inset-y-0 right-0 flex max-w-full pl-10">
        <Transition
          enter-active-class="transform transition ease-in-out duration-300"
          enter-from-class="translate-x-full"
          enter-to-class="translate-x-0"
          leave-active-class="transform transition ease-in-out duration-300"
          leave-from-class="translate-x-0"
          leave-to-class="translate-x-full"
        >
          <div v-show="show" :class="['w-screen flex flex-col h-full bg-white shadow-xl', sizeClasses[size]]">
            <div class="flex items-center justify-between px-6 py-4 border-b">
              <h2 v-if="title" class="text-lg font-semibold">{{ title }}</h2>
              <button v-if="showCloseButton" @click="close" class="text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
              </button>
            </div>
            <div class="flex-1 overflow-y-auto px-6 py-4"><slot /></div>
            <div v-if="$slots.footer" class="px-6 py-4 border-t"><slot name="footer" /></div>
          </div>
        </Transition>
      </div>
    </div>
  </Teleport>
</template>
