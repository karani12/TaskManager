<script setup="ts">
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <div class="already-have-acc flex gap-2 text-sm">
        <p class="text-gray-400">Already have an account?</p>
        <Link :href="route('login')" class="text-primary-600">Login</Link>
    </div>
    
</template>