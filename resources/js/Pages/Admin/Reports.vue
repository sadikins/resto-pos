<template>
    <AdminLayout title="Reports">
        <template #title>
            <h2 class="text-3xl font-semibold leading-loose text-white">
                Reports
            </h2>
            <div class="text-gray-200">Tuesday 2 Feb, 2002</div>
        </template>
        <template #aside>
            <h3>aside</h3>
        </template>
    </AdminLayout>
</template>

<script>
import AdminLayout from "../../Layouts/AdminLayout.vue";
export default {
    components: {
        AdminLayout,
    },
};
</script>
