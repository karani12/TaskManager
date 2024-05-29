<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
import { ChevronUpIcon } from '@heroicons/vue/20/solid'
</script>


<template>
    <div class="w-full">
      <div class="mx-auto w-full  p-2 border-b-2 border-slate-400">
        <Disclosure  v-slot="{ open }">
          <DisclosureButton
            class="flex w-full justify-between  shadow-none  px-4 py-2 text-left text-sm font-medium
            "
          >
            <slot name="title"></slot>
            <ChevronUpIcon
              :class="open ? 'rotate-180 transform' : ''"
              class="h-5 w-5 text-primary-500"
            />
          </DisclosureButton>
          <DisclosurePanel class="md:px-4 pb-2 pt-4 text-sm text-gray-500">
            <slot name="body"></slot>
          </DisclosurePanel>
        </Disclosure>
      </div>
    </div>
  </template>
  

  
