<script lang="ts" setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';

interface Props {
    text?: string;
    href?: string;
}

const props = defineProps<Props>();


</script>

<template>
    <button class="w-full py-4  rounded-md flex gap-3 items-center">
        <Link :href="props?.href || ''">
        <div class="icon bg-gray-100 p-3 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>

        </div>
        </Link>
        <span class="text-2xl font-bold" v-if="text">{{ text }}</span>
    </button>
</template>
