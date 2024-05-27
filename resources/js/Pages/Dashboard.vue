<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import SearchInput from '@/Components/SearchInput.vue';
import Accordion from '@/Components/Accordion.vue';
import Listbox from '@/Components/ListBox.vue';
import Popover from '@/Components/Popover.vue';
import Stats from '@/Components/Dashboard/Stats.vue';

import { ref } from 'vue';

const items = [
    { id: 1, name: 'Item 1' },
    { id: 2, name: 'Item 2' },
    { id: 3, name: 'Item 3' },
    { id: 4, name: 'Item 4' },
    { id: 5, name: 'Item 5' },
];

const selectedId = ref(items[0].id);


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
                            <button class="bg-primary-600 text-white px-4 py-2 rounded-md flex gap-2">
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
                    <div class="filter-search flex">
                        <div class="search w-1/3">
                            <SearchInput />
                        </div>
                        <div class="filter flex w-2/3">
                            <div class="box relative w-1/3">
                                <Listbox v-model="selectedId" :items="items" />
                            </div>
                            <div class="box relative w-1/3">
                                <Listbox v-model="selectedId" :items="items" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
