<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps<{
    question: string;
    href: string;
    linkText: string;
}>();
</script>

<template>
    <div class="already-have-acc flex gap-2 text-sm">
        <p class="text-gray-400">
            {{ props.question }}
        </p>
        <Link :href="props.href" class="text-primary-600">
            {{ props.linkText }}
        </Link>
    </div>
</template>
