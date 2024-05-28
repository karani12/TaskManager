<script setup lang="ts">
import StatsCard from './StatCard.vue';
import Icon from '@/Components/Icons/Icon.vue';
import HighIcon from '@/Components/Icons/HighIcon.vue';
import HighestIcon from '@/Components/Icons/HighestIcon.vue';
import MediumIcon from '@/Components/Icons/MediumIcon.vue';
import LowIcon from '@/Components/Icons/LowIcon.vue';
import LowestIcon from '@/Components/Icons/LowestIcon.vue';
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
            <StatsCard name="Pending" :number="$page.props.completedTasks" class="bg-warning-50 justify-between">
                <template #sub-stats>
                    <div class="stats flex gap-2 pt-4">
                    <div class="flex items-center gap-1">
                        <component :is="HighestIcon" class="text-danger-600"></component>

                        <span class="text-black">
                            {{ $page.props.substats.pendingHighest }}
                        </span>
                    </div>
                    <div class="flex items-center gap-1">
                        <component :is="MediumIcon" class="text-primary-600"></component>

                        <span class="text-black ">
                            {{ $page.props.substats.pendingMedium }}
                        </span>
                    </div>
                    <div class="flex items-center gap-1">
                        <component :is="LowestIcon" class="text-primary-600"></component>

                        <span class="text-black	">
                            {{ $page.props.substats.pendingLowest }}
                        </span>
                    </div>
                </div>

                </template>
            </StatsCard>
            <StatsCard name="Completed" :number="$page.props.completedTasks" class="bg-success-50" />
            <StatsCard name="Backlog" :number="$page.props.backlogTasks" class="bg-gray-50" />
        </div>
    </section>

</template>