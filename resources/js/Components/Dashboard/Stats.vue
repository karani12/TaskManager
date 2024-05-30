<script setup lang="ts">
import StatsCard from './StatCard.vue';
import HighestIcon from '@/Components/Icons/HighestIcon.vue';
import MediumIcon from '@/Components/Icons/MediumIcon.vue';
import LowestIcon from '@/Components/Icons/LowestIcon.vue';

</script>
<template>
    <section class="flex flex-col md:flex-row md:justify-between space-y-4 ">

        <div class="avatar flex space-x-3 items-center md:justify-center">
            <!-- @vue-ignore -->
            <img :src="$page.props.auth.user.avatar" alt="avatar" class="rounded-full w-16 h-16" />
            <div class="name">
                <h3 class="text-2xl font-bold">{{ $page.props.auth.user.name }}</h3>
                <p class="text-base text-gray-500">{{ $page.props.auth.user.email }}</p>
            </div>
        </div>
        <div class="stats flex gap-1 md:space-x-3">
            <!-- @vue-ignore -->
            <StatsCard name="Pending" :number="$page.props.completedTasks" class="bg-warning-50 justify-between">
                <template #sub-stats>
                    <div class="stats flex gap-1 pt-4">
                        <div class="flex items-center gap-1">
                            <component :is="HighestIcon" class="text-danger-600"></component>

                            <span class="text-black">
                                <!-- @vue-ignore -->
                                <!-- @vue-skip -->
                                {{ $page.props.substats.pendingHighest }}
                            </span>
                        </div>
                        <div class="flex items-center gap-1">
                            <component :is="MediumIcon" class="text-primary-600"></component>

                            <span class="text-black ">
                                <!-- @vue-ignore -->
                                {{ 
                                //@ts-ignore
                                $page.props.substats.pendingMedium 
                                }}
                            </span>
                        </div>
                        <div class="flex items-center gap-1">
                            <component :is="LowestIcon" class="text-primary-600"></component>

                            <span class="text-black	">
                                <!-- @vue-ignore -->
                                {{
                                //@ts-ignore
                                 $page.props.substats.pendingLowest
                                }}
                            </span>
                        </div>
                    </div>

                </template>
            </StatsCard>
            <!-- @vue-ignore -->
            <StatsCard name="Completed" :number="$page.props.completedTasks" class="bg-success-50" />

            <!-- @vue-ignore -->
            <StatsCard name="Backlog" :number="$page.props.backlogTasks" class="bg-gray-50" />
        </div>
    </section>

</template>