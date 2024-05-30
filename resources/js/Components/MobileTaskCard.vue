<script setup lang="ts">
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import EditTask from '@/Components/Dashboard/EditTask.vue';
import Badge from './Badge.vue';
import Icon from '@/Components/Icons/Icon.vue';
import HighIcon from '@/Components/Icons/HighIcon.vue';
import HighestIcon from '@/Components/Icons/HighestIcon.vue';
import MediumIcon from '@/Components/Icons/MediumIcon.vue';
import LowIcon from '@/Components/Icons/LowIcon.vue';
import LowestIcon from '@/Components/Icons/LowestIcon.vue';
import { CheckCircleIcon, PencilIcon } from '@heroicons/vue/20/solid';

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

const form = useForm({
    id: props.task.id,
    status: props.task.status,
    title: props.task.title,
    description: props.task.description,
    due_date: props.task.due_date,
    priority: props.task.priority,
});

const showModal = ref(false);
const startX = ref<number | null>(null);
const currentX = ref<number | null>(null);
const moveX = ref<number>(0);
const actionType = ref<string | null>(null);

const handleTouchStart = (event: TouchEvent) => {
    startX.value = event.touches[0].clientX;
};

const handleTouchMove = (event: TouchEvent) => {
    if (!startX.value) return;

    currentX.value = event.touches[0].clientX;
    moveX.value = currentX.value - startX.value;

    if (moveX.value > 50) {
        actionType.value = 'right';
    } else if (moveX.value < -50) {
        actionType.value = 'left';
    } else {
        actionType.value = null;
    }
};

const handleTouchEnd = () => {
    if (actionType.value === 'left') {
        moveX.value = -100;
    } else if (actionType.value === 'right') {
        moveX.value = 100;
    } else {
        moveX.value = 0;
    }
    startX.value = null;
    currentX.value = null;
    actionType.value = null;
};

const updateTask = (newStatus: string) => {
    form.status = newStatus;
    form.patch(route('tasks.update', props.task.id), {
        onFinish: () => {
            form.reset();
            moveX.value = 0;
        },
        preserveState: true,
        preserveScroll: true,
    });
};

const deleTeTask = () => {
    form.delete(route('tasks.destroy', props.task.id), {
        onFinish: () => {
            form.reset();
            moveX.value = 0;

        },
        preserveState: true,
        preserveScroll: true,

    });
};
</script>

<template>
    <section class="relative my-3">
        <div class="absolute top-0 left-0 w-full h-full flex">
            <div class=" w-[50px] bg-green-500 flex rounded-l-md items-center justify-center text-white">
                <button @click="updateTask('completed')" class="flex items-center gap-2">
                    <CheckCircleIcon class="h-6 w-6" />
                </button>
            </div>
            <div class=" w-[50px] bg-gray-500 flex items-center  justify-center text-white">
                <button @click="updateTask('backlog')" class="flex items-center gap-2">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.5 7.5H13.75C15.8211 7.5 17.5 9.17893 17.5 11.25C17.5 13.3211 15.8211 15 13.75 15H10M2.5 7.5L5.83333 4.16666M2.5 7.5L5.83333 10.8333"
                            stroke="white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>


        </div>
        <div class="absolute top-0 right-0 w-[100px] rounded-lg h-full flex">
            <div class="w-1/2 bg-red-500 flex items-center justify-center text-white">
                <button @click="deleTeTask" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
            </div>

        </div>
        <div class="relative p-4 bg-white border rounded-md transition-transform duration-300"
            :style="{ transform: `translateX(${moveX}px)` }" @touchstart="handleTouchStart" @touchmove="handleTouchMove"
            @touchend="handleTouchEnd">
            <EditTask :showModal="showModal" :task="task" />
            <div>
                <h1 class="text-lg md:text-xl font-bold text-black">{{ props.task.title }}</h1>
                <p class="font-bold text-sm">{{ props.task.due_date ? new Date(props.task.due_date).toDateString() : ''
                    }}</p>
                <p class="mt-3 text-sm md:text-base">{{ props.task.description }}</p>
                <div class="others mt-3 flex gap-2">
                    <Badge v-if="props.task.status === 'pending'" :text="props.task.status" :icon="Icon"
                        class="text-warning-400" />
                    <Badge v-if="props.task.status === 'completed'" :text="props.task.status" :icon="Icon"
                        class="text-success-400" />
                    <Badge v-if="props.task.status === 'backlog'" :text="props.task.status" :icon="Icon"
                        class="text-gray-400" />
                    <Badge v-if="props.task.priority === 'high'" :text="props.task.priority" :icon="HighIcon"
                        class="text-danger-600" />
                    <Badge v-if="props.task.priority === 'highest'" :text="props.task.priority" :icon="HighestIcon"
                        class="text-danger-600" />
                    <Badge v-if="props.task.priority === 'medium'" :text="props.task.priority" :icon="MediumIcon"
                        class="text-primary-600" />
                    <Badge v-if="props.task.priority === 'lowest'" :text="props.task.priority" :icon="LowestIcon"
                        class="text-primary-600" />
                    <Badge v-if="props.task.priority === 'low'" :text="props.task.priority" :icon="LowIcon"
                        class="text-primary-600" />
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.section {
    position: relative;
    overflow: hidden;
}

.actions {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
}
</style>
