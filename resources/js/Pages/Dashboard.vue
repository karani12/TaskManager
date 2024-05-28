<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import SearchInput from '@/Components/SearchInput.vue';
import Listbox from '@/Components/ListBox.vue';
import Popover from '@/Components/Popover.vue';
import Stats from '@/Components/Dashboard/Stats.vue';
import TaskAccordion from '@/Components/Dashboard/TasksAccordion.vue';
import { Icon, HighIcon, HighestIcon, LowestIcon, MediumIcon, LowIcon } from '@/Components/util/icons';
import CreateTask from '@/Components/Dashboard/CreateTask.vue';


import { ref } from 'vue';

const items = [
    { id: 1, name: 'Item 1' },
    { id: 2, name: 'Item 2' },
    { id: 3, name: 'Item 3' },
    { id: 4, name: 'Item 4' },
    { id: 5, name: 'Item 5' },
];

const priority = [
    { id: 1, name: 'High', icon: HighIcon, color: 'text-danger-600', },
    { id: 2, name: 'Highest', icon: HighestIcon, color: 'text-danger-600', },
    { id: 3, name: 'Medium', icon: MediumIcon, color: 'text-primary-600', },
    { id: 4, name: 'Lowest', icon: LowestIcon, color: 'text-primary-600', },
    { id: 5, name: 'Low', icon: LowIcon, color: 'text-primary-600', },
]

const status = [
    { id: 1, name: 'Pending', icon: Icon, color: 'text-warning-400', },
    { id: 2, name: 'Completed', icon: Icon, color: 'text-success-400', },
    { id: 3, name: 'Backlog', icon: Icon, color: 'text-gray-400', },
]

const selectedId = ref(items[0].id);

const showModal = ref(false);


</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden  sm:rounded-lg max-w-4xl mx-auto">
                    <Stats />
                    <!-- title -->
                    <div class="title flex justify-between items-center mt-4">
                        <h1 class="text-3xl font-semibold text-gray-900">Todos</h1>
                        <div class="create-tasks">
                            <button class="bg-primary-600 text-white px-4 py-2 rounded-md flex gap-2"
                                @click="showModal=true"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>

                                <span>
                                    Add Todo
                                </span>
                            </button>
                        </div>
                    </div>
                    <!-- title -->

                    <!-- search plus filter -->
                    <div class="filter-search flex mt-3 gap-3 justify-center content-center">
                        <div class="search w-1/2">
                            <SearchInput />
                        </div>

                        <div class="filter w-1/2 flex gap-3">
                            <div class="box relative w-1/2 ">
                                <Listbox v-model="selectedId" :items="status" name="status" />
                            </div>
                            <div class="relative max-w-11 ">
                                <Listbox v-model="selectedId" :items="priority" name="Priority" />
                            </div>
                        </div>
                    </div>
                    <!-- modal -->
                    <CreateTask :showModal="showModal" />
                    <!-- ttitle stuff -->
                    <TaskAccordion />

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>