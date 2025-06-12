<template>
    <Head title="Distributors" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Distributors</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Auth Debug Info -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6">
                    <h3 class="text-lg font-medium text-gray-900">Authentication Debug</h3>
                    <div class="mt-2">
                    </div>
                </div>

                <DistributorList />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DistributorList from '@/Components/Distributors/DistributorList.vue';

defineProps({
    authCheck: Object
});
</script>