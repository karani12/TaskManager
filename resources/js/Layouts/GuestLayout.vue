<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div class="mt-3 flex items-center justify-center">
        <Link href="/">
        <ApplicationLogo class="" />
        </Link>
    </div>
    <div class="min-h-screen flex flex-col  justify-center items-center pt-6 sm:pt-0 bg-white px-3">

        <div class="w-full sm:max-w-md mt-6 px-3 md:px-6 py-4 bg-white md:border md:border-gray-200 overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
