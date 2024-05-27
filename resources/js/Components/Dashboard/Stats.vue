<script setup lang="ts">
import StatsCard from './StatCard.vue';
</script>
<template>
    <section class="flex justify-between">

        <div class="avatar flex space-x-3 items-center justify-center">
            <img :src="$page.props.auth.user.avatar" alt="avatar" class="rounded-full w-16 h-16" />
            <div class="name">
                <h3 class="text-2xl font-bold">{{ $page.props.auth.user.name }}</h3>
                <p class="text-base text-gray-500">{{ $page.props.auth.user.email }}</p>
            </div>
        </div>
        <div class="stats flex space-x-3">
            <StatsCard name="Pending" :number="10" class="bg-warning-50 justify-between" >
                <template #sub-stats>
                    <p class="text-gray-400 mt-5">Sub Stats</p>
                </template>
            </StatsCard>
            <StatsCard name="Completed" :number="20" class="bg-success-50" />
            <StatsCard name="Total" :number="30" class="bg-gray-50" />
        </div>
    </section>

</template>