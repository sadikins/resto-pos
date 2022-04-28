<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateTeamForm from "@/Pages/Teams/Partials/CreateTeamForm.vue";
import AdminLayout from "../../Layouts/AdminLayout.vue";
</script>

<template>
    <AdminLayout title="Create Team">
        <template #title>
            <h2 class="text-3xl font-semibold leading-loose text-white">
                Create Team
            </h2>
            <div class="text-gray-200">Tuesday 2 Feb, 2002</div>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <CreateTeamForm />
            </div>
        </div>
    </AdminLayout>
</template>
