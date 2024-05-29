<script setup lang="ts">
import Popover from './Popover.vue';
import Badge from './Badge.vue';
import { ChevronUpIcon } from '@heroicons/vue/20/solid';
import { defineProps } from 'vue';
import Icon from '@/Components/Icons/Icon.vue';
import HighIcon from '@/Components/Icons/HighIcon.vue';
import HighestIcon from '@/Components/Icons/HighestIcon.vue';
import MediumIcon from '@/Components/Icons/MediumIcon.vue';
import LowIcon from '@/Components/Icons/LowIcon.vue';
import LowestIcon from '@/Components/Icons/LowestIcon.vue';
import { CheckCircleIcon, PencilIcon } from '@heroicons/vue/20/solid';
import { Link, useForm, router } from '@inertiajs/vue3'
import EditTask from '@/Components/Dashboard/EditTask.vue';
import { ref } from 'vue';

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


// forms

const form = useForm({
    id: props.task.id,
    status: props.task.status,
    title: props.task.title,
    description: props.task.description,
    due_date: props.task.due_date,
    priority: props.task.priority,

});

const updateTask = (newStatus: string) => {
    console.log(newStatus);
    form.status = newStatus;
    form.patch(route('tasks.update', props.task.id), {
        onFinish: () => {
            form.reset('status');
            router.reload({
                only: ['tasks'],
            });
        },
    });

};


const deleTeTask = () => {
    form.delete(route('tasks.destroy', props.task.id), {
        onFinish: () => {
            form.reset('status');
            router.reload({
                only: ['tasks'],
            });
        },
    });
};

const showModal = ref(false);


</script>

<template>
    <section class="border relative  rounded-md text-base p-2 md:p-4 my-3 flex justify-between">
        <EditTask :showModal="showModal" :task="task" />

        <div class="">
            <h1 class=" text-lg md:text-xl font-bold text-black">{{ props.task.title }}</h1>
            <p class="font-bold text-sm">{{ props.task.due_date ? new Date(props.task.due_date).toDateString() : '' }}</p>
            <p class="mt-3 text-sm md:text-base"> {{ props.task.description }}</p>
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
                <Badge v-if="props.task.priority === 'medium'" :text="props.task.priority" :icon="MediumIcon"
                    class="text-primary-600" />
                <!-- lowest -->
                <Badge v-if="props.task.priority === 'lowest'" :text="props.task.priority" :icon="LowestIcon"
                    class="text-primary-600" />
                <!-- low -->
                <Badge v-if="props.task.priority === 'low'" :text="props.task.priority" :icon="LowIcon"
                    class="text-primary-600" />
            </div>
        </div>
        <div class="actions hidden md:block">
            <Popover>
                <template #panel>
                    <div class="flex flex-col gap-2 space-y-3">
                        <button class="text-success-600 flex items-center gap-2" @click="updateTask('completed')">
                            <CheckCircleIcon class="h-6 w-6" />
                            Mark as Completed

                        </button>
                        <button class="flex items-center gap-2 text-black" @click="updateTask('backlog')">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.5 7.5H13.75C15.8211 7.5 17.5 9.17893 17.5 11.25C17.5 13.3211 15.8211 15 13.75 15H10M2.5 7.5L5.83333 4.16666M2.5 7.5L5.83333 10.8333"
                                    stroke="#111827" stroke-width="1.66667" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>

                            Move to backlog
                        </button>
                        <button class="flex items-center gap-2 text-black" @click="showModal = true">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.5001 17.5H10.8334M2.08337 17.9167L6.70776 16.1381C7.00355 16.0243 7.15144 15.9674 7.28981 15.8931C7.41271 15.8272 7.52987 15.751 7.64007 15.6655C7.76414 15.5692 7.87619 15.4572 8.10027 15.2331L17.5001 5.83333C18.4205 4.91286 18.4205 3.42047 17.5001 2.5C16.5796 1.57952 15.0872 1.57952 14.1667 2.5L4.76694 11.8998C4.54285 12.1239 4.43081 12.2359 4.33453 12.36C4.24902 12.4702 4.17288 12.5873 4.1069 12.7102C4.03263 12.8486 3.97575 12.9965 3.86198 13.2923L2.08337 17.9167ZM2.08337 17.9167L3.79847 13.4575C3.9212 13.1384 3.98257 12.9788 4.08782 12.9057C4.17981 12.8419 4.29363 12.8177 4.40362 12.8387C4.52948 12.8628 4.65036 12.9836 4.89211 13.2254L6.77469 15.108C7.01643 15.3497 7.13731 15.4706 7.16134 15.5964C7.18235 15.7064 7.1582 15.8203 7.09433 15.9122C7.02125 16.0175 6.8617 16.0789 6.5426 16.2016L2.08337 17.9167Z"
                                    stroke="black" stroke-width="1.66667" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>


                            Edit Todo
                        </button>

                        <button class="text-danger-600 flex items-center gap-2" @click="deleTeTask">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>

                            Delete

                        </button>
                    </div>
                </template>
            </Popover>
        </div>
    </section>
</template>