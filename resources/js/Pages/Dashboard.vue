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
import MobileTaskCard from '@/Components/MobileTaskCard.vue';
import CreateTask from '@/Components/Dashboard/CreateTask.vue';
import TaskCard from '@/Components/TaskCard.vue';
import EmptyState from '@/Components/EmptyState.vue';


import { ref, watch, computed, h, onMounted } from 'vue';
const {
    props,
} = usePage();


const priority = [
    { id: 'all', name: 'All', icon: Icon, color: 'text-gray-400', },
    { id: 'highest', name: 'Highest', icon: HighestIcon, color: 'text-danger-600', },
    { id: 'high', name: 'High', icon: HighIcon, color: 'text-danger-600', },
    { id: 'medium', name: 'Medium', icon: MediumIcon, color: 'text-primary-600', },
    { id: 'medium', name: 'Low', icon: LowIcon, color: 'text-primary-600', },
    { id: 'lowest', name: 'Lowest', icon: LowestIcon, color: 'text-primary-600', },
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


const handleSearch = (value: any) => {
    searchValue.value = value;
}
const showModal = ref(false);

const openModal = () => {
    showModal.value = true;
}


</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="py-12 ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden px-3  sm:rounded-lg max-w-4xl mx-auto">
                    <Stats class="py-3 px-3 md:px-0 md:py-0" />
                    <!-- title -->
                    <div class="title flex justify-between items-center mt-4">
                        <h1 class="text-3xl font-semibold text-gray-900">Todos</h1>
                        <div class="create-tasks px-3 md:px-0">
                            <button class="bg-primary-600 text-white px-4 py-2 rounded-md flex gap-2"
                                @click="openModal">
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
                    <div
                        class="filter-search flex mx-3 md:mx-0 flex-col md:flex-row mt-3 space-y-3 md:space-y-0 gap-3 justify-center content-center">
                        <div class="search w-full md:w-1/2">
                            <SearchInput @update:modelValue="handleSearch" />
                        </div>

                        <div class="filter w-full md:w-1/2 flex flex-col md:flex-row  gap-3">
                            <div class="relative w-full md:w-1/2 ">
                                <Listbox v-model="selectedPriority" :items="priority" name="status" />
                            </div>
                            <div class="relative w-full md:max-w-11 ">
                                <Listbox v-model="selectedStatus" :items="status" name="Priority" />
                            </div>
                        </div>
                    </div>
                    <!-- modal -->

                    <CreateTask @update:showModal="showModal = $event" :showModal="showModal" />
                    <!-- ttitle stuff -->
                    <div class="min-h-[300px]">

                        <TaskAccordion class="min-h-[300px] w-full"
                            v-if="selectedStatus === 'all' && selectedPriority === 'all' && searchValue === ''" />

                            <!-- @vue-skip -->
                            <!-- @vue-ignore -->
                        <EmptyState v-else-if="($page.props.tasks as Array<any>).length === 0" />
                        <div v-else v-for="task in $page.props.tasks" class="seen ">

                            <TaskCard :task="task" class="hidden md:flex" />
                            <MobileTaskCard :task="task" class="md:hidden" />

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>