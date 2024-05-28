<script setup lang="ts">
import StatsCard from './StatCard.vue';
import { HighestIcon, LowestIcon, MediumIcon, LowIcon } from '@/Components/util/icons';
const filterByPriority = (tasks: Task[], priority: string) => {
    return tasks.filter((task) => task.priority === priority);
};

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
            <StatsCard name="Pending" :number="$page.props.tasks.pending.length" class="bg-warning-50 justify-between">
                <template #sub-stats>
                    <div class="stats flex gap-2 pt-4">

                    <!-- highest priority no -->
                    <div class="flex items-center gap-1">
                        <span class="text-danger-600" v-html="HighestIcon"></span>
                        <span class="text-black">
                            {{ filterByPriority($page.props.tasks.pending, 'highest').length }}
                        </span>
                    </div>
                    <!-- medium -->
                    <div class="flex items-center gap-1">
                        <span class="text-primary-600" v-html="MediumIcon"></span>
                        <span class="text-black ">
                            {{ filterByPriority($page.props.tasks.pending, 'medium').length }}
                        </span>
                    </div>
                    <!-- lowest -->
                    <div class="flex items-center gap-1">
                        <span class="text-primary-600" v-html="LowestIcon"></span>
                        <span class="text-black	">
                            {{ filterByPriority($page.props.tasks.pending, 'lowest').length }}
                        </span>
                    </div>
                </div>

                </template>
            </StatsCard>
            <StatsCard name="Completed" :number="$page.props.tasks.completed.length" class="bg-success-50" />
            <StatsCard name="Backlog" :number="$page.props.tasks.backlog.length" class="bg-gray-50" />
        </div>
    </section>

</template>