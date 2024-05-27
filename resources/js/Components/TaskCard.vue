<script setup lang="ts">
import Popover from './Popover.vue';
import Badge from './Badge.vue';
import { ChevronUpIcon } from '@heroicons/vue/20/solid';
import { defineProps } from 'vue';
import { Icon, HighIcon, HighestIcon, LowestIcon, MediumIcon, LowIcon } from './util/icons';

type Task = {
    id: number;
    title: string;
    description: string;
    date: string;
    status: string;
    due_date: string;
    priority: string;
    user_id: number;
    created_at: string;
    updated_at: string;
};





const props = defineProps<{
    task: Task;
}>();
</script>

<template>
    <section class="border rounded-md text-base p-4 my-3 flex justify-between">
        <div class="">
            <h1 class="text-xl font-bold text-black">{{ props.task.title }}</h1>
            <p class="font-bold">{{
                new Date(props.task.date).toDateString()
            }}</p>
            <p class="mt-3"> {{ props.task.description }}</p>
            <div class="others mt-3 flex gap-2">
                <Badge v-if="props.task.status === 'pending'" :text="props.task.status" :icon="Icon"
                    class="text-warning-400" />
                <!-- completed -->
                <Badge v-if="props.task.status === 'completed'" :text="props.task.status" :icon="Icon"
                    class="text-success-400" />
                <!-- backlog -->
                <Badge v-if="props.task.status === 'backlog'" :text="props.task.status" :icon="Icon"
                    class="text-gray-400" />
                <!-- high -->
                <Badge v-if="props.task.priority === 'high'" :text="props.task.priority" :icon="HighIcon"
                    class="text-danger-600" />
                <!-- highest -->
                <Badge v-if="props.task.priority === 'highest'" :text="props.task.priority" :icon="HighestIcon"
                    class="text-danger-600" />
                <!-- medium -->
                <Badge v-if="props.task.priority === 'medium'" :text="props.task.priority" :icon="Medium"
                    class="text-primary-600" />
                <!-- lowest -->
                <Badge v-if="props.task.priority === 'lowest'" :text="props.task.priority" :icon="LowestIcon"
                    class="text-primary-600" />
                <!-- low -->
                <Badge v-if="props.task.priority === 'low'" :text="props.task.priority" :icon="LowIcon"
                    class="text-primary-600" />
            </div>
        </div>
        <div class="actions">
            <Popover>
                <template #trigger>
                    <button class="btn">Actions</button>
                </template>
                <template #content>
                    <ul class="list">
                        <li class="list-item">Edit</li>
                        <li class="list-item">Delete</li>
                    </ul>
                </template>
            </Popover>
        </div>
    </section>

</template>