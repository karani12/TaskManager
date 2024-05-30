<script setup>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
defineProps({ status: Boolean})

</script>

<template>
    <div class="max-w-sm px-4 ">
        <Popover v-slot="{ open }" class="relative">
            <PopoverButton class="">
                <span class="font-bold leading-snug text-2xl tracking-wider">
                    ...
                </span>
            </PopoverButton>

            <transition enter-active-class="transition duration-200 ease-out" enter-from-class="translate-y-1 opacity-0"
                enter-to-class="translate-y-0 opacity-100" leave-active-class="transition duration-150 ease-in"
                leave-from-class="translate-y-0 opacity-100" leave-to-class="translate-y-1 opacity-0">
                <PopoverPanel class="absolute left-1/2 z-10 mt-3 w-52 max-w-sm -translate-x-3/4 ">
                    <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black/5">
                        <div class=" bg-white p-3 space-y-2">
                            <slot name="panel">
                            </slot>
                        </div>

                    </div>
                </PopoverPanel>
            </transition>
        </Popover>
    </div>
</template>

