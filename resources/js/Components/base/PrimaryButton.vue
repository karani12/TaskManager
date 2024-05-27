<script lang="ts" setup>
import { defineProps, computed } from 'vue';

interface Props {
    extraClasses?: string;
    text?: string;
}

const props = defineProps<Props>();

const buttonClasses = computed(() => {
    const baseClasses = 'w-full py-4 px-4 py-2 rounded-md flex gap-3';
    return `${baseClasses} ${props.extraClasses || ''}`;
});
</script>

<template>
    <button :class="buttonClasses">
        <span v-if="$slots.icon" class="icon-wrapper">
            <slot name="icon"></slot>
        </span>
        <span v-if="text">{{ text }}</span>
    </button>
</template>
