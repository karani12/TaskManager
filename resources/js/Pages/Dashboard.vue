<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, router } from '@inertiajs/vue3';
import SearchInput from '@/Components/SearchInput.vue';
import Listbox from '@/Components/ListBox.vue';
import Popover from '@/Components/Popover.vue';
import Stats from '@/Components/Dashboard/Stats.vue';
import TaskAccordion from '@/Components/Dashboard/TasksAccordion.vue';
import Icon from '@/Components/Icons/Icon.vue';
import HighIcon from '@/Components/Icons/HighIcon.vue';
import HighestIcon from '@/Components/Icons/HighestIcon.vue';
import MediumIcon from '@/Components/Icons/MediumIcon.vue';
import LowIcon from '@/Components/Icons/LowIcon.vue';
import LowestIcon from '@/Components/Icons/LowestIcon.vue';


import CreateTask from '@/Components/Dashboard/CreateTask.vue';
import TaskCard from '@/Components/TaskCard.vue';


import { ref, watch, computed, h } from 'vue';
const {
    visit,
    props,

} = usePage();


const priority = [
    { id: 'all', name: 'All', icon: h(Icon), color: 'text-gray-400', },
    { id: 'high', name: 'High', icon: h(HighIcon), color: 'text-danger-600', },
    { id: 'highest', name: 'Highest', icon: HighestIcon, color: 'text-danger-600', },
    { id: 'medium', name: 'Medium', icon: MediumIcon, color: 'text-primary-600', },
    { id: 'lowest', name: 'Lowest', icon: LowestIcon, color: 'text-primary-600', },
    { id: 'medium', name: 'Low', icon: LowIcon, color: 'text-primary-600', },
]

const status = [
    { id: 'all', name: 'All', icon: Icon, color: 'text-gray-400', },
    { id: 'pending', name: 'Pending', icon: Icon, color: 'text-warning-400', },
    { id: 'completed', name: 'Completed', icon: Icon, color: 'text-success-400', },
    { id: 'backlog', name: 'Backlog', icon: Icon, color: 'text-gray-400', },
]

const selectedPriority = ref(priority[0].id);
const selectedStatus = ref(status[0].id);



watch([selectedPriority, selectedStatus], () => {
    router.get('/dashboard', {
        priority: selectedPriority.value,
        status: selectedStatus.value,
    }, { preserveState: true })


});
const searchValue = ref('');

watch(searchValue, () => {
    router.get('/dashboard', {
        search: searchValue.value,
    }, { preserveState: true })
});


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
                                @click="showModal = true">
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
                            <SearchInput v-model="searchValue" />
                        </div>

                        <div class="filter w-1/2 flex gap-3">
                            <div class="box relative w-1/2 ">
                                <Listbox v-model="selectedPriority" :items="priority" name="status" />
                            </div>
                            <div class="relative max-w-11 ">
                                <Listbox v-model="selectedStatus" :items="status" name="Priority" />
                            </div>
                        </div>
                    </div>
                    <!-- modal -->
                    <CreateTask :showModal="showModal" />
                    <!-- ttitle stuff -->
                    <TaskAccordion v-if="selectedStatus === 'all' && selectedPriority === 'all' && searchValue === ''" />
                    <div v-else v-for="task in $page.props.tasks" class="seen ">
                        <TaskCard :task="task" />

                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>