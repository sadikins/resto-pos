<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
</script>

<template>
    <AdminLayout title="Dashboard">
        <template #title>
            <h2 class="text-3xl font-semibold leading-loose text-white">
                Dashboard
            </h2>
            <div class="text-gray-200">Tuesday 2 Feb, 2002</div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-gray-700 overflow-hidden shadow-xl sm:rounded-lg"
                >
                    <div v-if="$page.props.user.current_team_id == 1">
                        <Welcome />
                    </div>
                    <div v-else class="p-5 text-white">Halaman Cashier</div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
