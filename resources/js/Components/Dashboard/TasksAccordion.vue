<script setup lang="ts">
import Accordion from '@/Components/Accordion.vue';
import TaskCard from '@/Components/TaskCard.vue';
const task = {
    id: 1,
    title: 'Task 1',
    description: 'This is a task',
    date: '2021-10-10',
    status: 'pending',
    due_date: '2021-10-10',
    priority: 'medium',
    user_id: 1,
    created_at: '2021-10-10',
    updated_at: '2021-10-10',
};

</script>
<template>
    <!-- pending -->
    <Accordion >
        <template #title>
            <h1 class="text-2xl font-black">Pending</h1>
        </template>
        <template #body>
            <div>
                <TaskCard :task="task" />
                <TaskCard :task="task" />
                <TaskCard :task="task" />
            </div>
        </template>
    </Accordion>
    <!-- completed -->
    <Accordion >
        <template #title>
            <h1 class="text-2xl font-black">Completed</h1>
        </template>
        <template #body>
            <div>
                <p>Task 1</p>
                <p>Task 2</p>
                <p>Task 3</p>
            </div>
        </template>
    </Accordion>

    <!-- backlog -->
    <Accordion >
        <template #title>
            <h1 class="text-2xl font-black">Backlog</h1>
        </template>
        <template #body>
            <div>
                <p>Task 1</p>
                <p>Task 2</p>
                <p>Task 3</p>
            </div>
        </template>
    </Accordion>

</template>