<script setup lang="ts">
import { defineProps, computed } from 'vue';
const props = defineProps<{
    icon: string;
    text: string;
    fill?: string;
}>();

const base = 'px-4 min-w-28  rounded-md flex flex-col ';
</script>

<template>
    <div class=" flex items-center gap-1 w-fit px-1 justify-center bg-gray-50 rounded-lg ">
        <div :class="fill" v-html="props.icon"></div>
        <p class="text-black">{{ props.text }}</p>
    </div>
</template>