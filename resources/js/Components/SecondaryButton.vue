<script setup lang="ts">
withDefaults(
    defineProps<{
        type?: 'button' | 'submit' | 'reset';
    }>(),
    {
        type: 'button',
    }
);
</script>

<template>
    <button
        :type="type"
        class="w-full py-4 px-4  rounded-md flex gap-3"
    >
        <slot />
    </button>
</template>
