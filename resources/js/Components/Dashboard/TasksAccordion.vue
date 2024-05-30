<script setup lang="ts">
import Accordion from '@/Components/Accordion.vue';
import TaskCard from '@/Components/TaskCard.vue';
import MobileTaskCard from '@/Components/MobileTaskCard.vue';
import EmptyState from '../EmptyState.vue';
import { usePage } from '@inertiajs/vue3';


</script>
<template>
    <!-- pending -->
    <div>

        <Accordion>
            <template #title>
                <h1 class="text-2xl font-black">Pending</h1>
            </template>
            <template #body>
                <!-- @vue-ignore -->
                <EmptyState v-if="!$page.props.tasks.pending" />

                <!-- @vue-ignore -->
                <div v-else v-for="task in $page.props.tasks.pending">
                    <TaskCard :task="task" class="hidden md:flex" />
                    <!-- @vue-ignore -->
                    <MobileTaskCard class="sm:hidden" :task="task" />
                </div>
            </template>
        </Accordion>
        <!-- completed -->
        <Accordion>
            <template #title>
                <h1 class="text-2xl font-black">Completed</h1>
            </template>
            <template #body>
                <!-- @vue-ignore -->
                <EmptyState v-if="!$page.props.tasks.completed" />
                <!-- @vue-ignore -->
                <div v-else v-for="task in $page.props.tasks.completed">
                    <TaskCard :task="task" class="hidden md:flex" />
                    <MobileTaskCard class="sm:hidden" :task="task" />

                </div>
            </template>
        </Accordion>

        <!-- backlog -->
        <Accordion>
            <template #title>
                <h1 class="text-2xl font-black">Backlog</h1>
            </template>
            <template #body>
                <!-- @vue-ignore -->

                <!-- @vue-ignore -->
                <EmptyState v-if="!$page.props.tasks.backlog" />

                <!-- @vue-ignore -->
                <div v-else v-for="task in $page.props.tasks.backlog">

                    <TaskCard :task="task" class="hidden md:flex" />
                    <MobileTaskCard class="sm:hidden" :task="task" />

                </div>
            </template>
        </Accordion>
    </div>


</template>