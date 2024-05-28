<script setup lang="ts">
import { defineProps, computed } from 'vue';


const props = defineProps<{
    name: string;
    number: number;
    class?: string;
}>();
console.log(props);
const base = 'px-4 min-w-28  rounded-md flex flex-col ';
const classes = computed(() => {
    return `${base} ${props.class || ''}`;
});



</script>

<template>
    <div :class="classes">
        <p class="text-gray-400 font-bold">{{ props.name }}</p>
        <h1 class="number text-4xl font-black">{{ props.number }}</h1>
        <slot name="sub-stats"></slot>
      
    </div>
</template>