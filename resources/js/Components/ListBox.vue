<script setup>
import { ref, computed, watch } from 'vue';
import { Listbox, ListboxButton, ListboxOptions, ListboxOption } from '@headlessui/vue';
import { CheckIcon, ChevronUpDownIcon, ChevronUpIcon } from '@heroicons/vue/20/solid';
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
    modelValue: {
        type: [String, Number],
        required: true,
    },
    name: {
        type: String,
        required: true,
    },
});

const emits = defineEmits(['update:modelValue']);

const selectedId = ref(props.modelValue);

const selectedItem = computed(() => {
    return props.items.find(item => item.id === selectedId.value);
});

watch(selectedId, (newValue) => {
    emits('update:modelValue', newValue);
});
</script>

<template>
    <div class="w-52">
        <Listbox v-model="selectedId">
            <div class="relative">
                <ListboxButton class="relative w-full cursor-default rounded-lg bg-white py-3 pl-3 pr-10 text-left border focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm">
                    <span class="block truncate">
                        <span class="capitalize">{{ name }}</span> : 
                        <span class="font-bold">{{ selectedItem ? selectedItem.name : 'Select an option' }}</span>
                    </span>
                    <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                        <ChevronUpIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                    </span>
                </ListboxButton>

                <transition leave-active-class="transition duration-100 ease-in" leave-from-class="opacity-100" leave-to-class="opacity-0">
                    <ListboxOptions class="absolute z-[9999] mt-1 min-h-fit min-w-52  overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm">
                        <ListboxOption v-slot="{ active, selected }" v-for="item in props.items" :key="item.id" :value="item.id">
                            <li :class="[
                                active ? 'bg-primary-100 text-primary-900' : 'text-gray-900',
                                'relative cursor-default select-none py-2 pl-10 pr-4 flex items-center gap-2',
                            ]">
                               <component :is="item.icon" :class="item.color"></component>
                                <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">{{ item.name }}</span>
                                <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3 text-primary-600">
                                    <!-- <CheckIcon class="h-5 w-5" aria-hidden="true" /> -->
                                </span>
                            </li>
                        </ListboxOption>
                    </ListboxOptions>
                </transition>
            </div>
        </Listbox>
    </div>
</template>
