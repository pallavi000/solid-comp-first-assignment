<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AddCurrentIpForm from './Partials/AddCurrentIpForm.vue';
import { Head } from '@inertiajs/vue3';
import RemoveCurrentIpForm from './Partials/RemoveCurrentIpForm.vue';


defineProps<{
    ip: string;
    isIpAllowed: boolean
}>();

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                    <div class="p-6 text-gray-900">Your current ip is: <h1 class="font-bold">{{ ip }}</h1>
                    </div>

                    <div v-if="isIpAllowed" class="p-6">
                        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
                            <span class="font-medium">Good News!</span> You are allowed to view restricted pages.
                        </div>
                    </div>

                    <div v-if="isIpAllowed" class="p-6">
                        <RemoveCurrentIpForm :ip="ip" />
                    </div>
                    <div v-else class="p-6">
                        <AddCurrentIpForm :ip="ip" />
                    </div>


                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
