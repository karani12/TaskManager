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
    form.post(route('tasks.update'), {
        onFinish: () => {
        console.log('submitted');

            router.reload({
                only: ['tasks'],
            });

        },
    });
};






watch(() => props.showModal, (value) => {
    showModal.value = value;
});


const showModal = ref(props.showModal);


</script>
<template>
    <Modal :show="showModal">
        <form>
            <div>
                <div class="status">
                    <div class="due">
                        <InputLabel for="priority" value="Priority" />
                        <!-- lowest, low, medium, high ,highest -->
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
                    <div class="status">
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
                    <MdEditor v-model="form.description" :preview=false :footers=[] :toolbars="toolbar"
                        :autoDetectCode=false class="max-h-[200px] border" />
                    <InputError :message="form.errors.priority" />
                </div>
                <div class="mt-4">
                    <PrimaryButton @click="submit" class="w-full">Create Task</PrimaryButton>
                </div>


            </div>

        </form>

    </Modal>

</template>