<script setup lang="ts">
import Modal from "@/Components/Modal.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthTitle from '@/Components/AuthTitle.vue';
import LoginLink from '@/Components/AuthLink.vue';
import { Head, Link, useForm, router, usePage } from '@inertiajs/vue3';
import { ref, watch, defineProps } from "vue";
import { MdEditor } from 'md-editor-v3';
import 'md-editor-v3/lib/style.css';

const props = defineProps<{
    showModal: boolean;
    task: any;
}>();

// get task
const { task } = props;

const toolbar =
    [
        'bold',
        'underline',
        'italic',
        'strikeThrough',
        'title',
        'sub',
        'unorderedList',
        'orderedList',
        'link',
        'table',
        'revoke',
        'next',
    ]


const form = useForm({
    title: task.title,
    description: task.description,
    due_date: task.due_date,
    priority: task.priority,
    status: task.status,
});

const submit = () => {
    form.patch(route('tasks.update', task.id), {
        onSuccess: () => {
            showModal.value = false;
        },
        only: ['tasks'],
        preserveState: true,
        preserveScroll: true,
    });
};


const showModal = ref(false);


const emit = defineEmits(['update:showModal']);

watch(() => props.showModal, (value) => {
    showModal.value = value;
});

watch(() => showModal.value, (value) => {
    emit('update:showModal', value);
});

const closeModal = () => {

    showModal.value = false;
}


</script>
<template>
    <Modal :show="showModal" @close="closeModal">
        <form @submit.prevent="submit">
            <div class="section border-b-2 pb-2">

                <button type="button" @click="closeModal"
                    class="w-full pt-3 pl-3 rounded-md flex gap-3 justify-between px-3 items-center">
                    <span class="text-2xl font-bold">Create Task</span>
                    <div class="icon bg-gray-100 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>

                    </div>

                </button>
            </div>


            <div class="px-2 md:px-7 pb-10 pt-5">
                <div class="status flex flex-col md:flex-row gap-2">
                    <div class="due md:w-1/2">
                        <InputLabel for="priority" value="Priority" />
                        <select id="priority" v-model="form.priority"
                            class="border-gray-300 w-full focus:border-primary-600 focus:ring-indigo-500 rounded-md py-3 shadow-sm"
                            required>
                            <option value="lowest">Lowest</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                            <option value="highest">Highest</option>
                        </select>
                        <InputError :message="form.errors.priority" />

                    </div>
                    <div class="status md:w-1/2">
                        <InputLabel for="status" value="Status" />
                        <select id="status" v-model="form.status"
                            class="border-gray-300 w-full focus:border-primary-600 focus:ring-indigo-500 rounded-md py-3 shadow-sm"
                            required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="backlog">Backlog</option>
                        </select>
                        <InputError :message="form.errors.priority" />
                    </div>

                </div>
                <!-- rest of inputs -->
                <div class="mt-4">
                    <InputLabel for="title" value="Title" />
                    <TextInput class="w-full" v-model="form.title" id="title" />
                    <InputError :message="form.errors.priority" />

                </div>
                <!-- due date -->
                <div class="mt-4">
                    <InputLabel for="due_date" value="Due Date" />
                    <TextInput class="w-full" v-model="form.due_date" id="due_date" type="date" />
                    <InputError :message="form.errors.priority" />
                </div>

                <div class="mt-4">
                    <InputLabel for="description" value="Description" />
                    <!-- @vue-ignore -->
                    <MdEditor v-model="form.description" :preview=false :footers=[] :toolbars="toolbar"
                        :autoDetectCode=false class="max-h-[200px] border" />
                    <InputError :message="form.errors.priority" />
                </div>
                <div class="mt-4 flex items-end justify-end gap-2">
                    <button
                    class="w-32 bg-gray-100 text-gray-900 py-3 rounded-md  text-center ">
                    Cancel
                    </button>
                    <PrimaryButton type="submit" class="max-w-36">Edit Task</PrimaryButton>
                </div>


            </div>

        </form>
    </Modal>

</template>