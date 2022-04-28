<template>
    <AdminLayout title="Dashboard">
        <template #title>
            <h1 class="text-3xl font-semibold leading-loose text-white">
                Rumah Makan Padang
            </h1>
            <div class="text-gray-200">Tuesday 2 Feb, 2002</div>
        </template>

        <StatsCard />
        <OrderReport />

        <template #aside>
            <MostOrdered />
            <MostTypeOfOrder />
        </template>
    </AdminLayout>
</template>

<script>
import { Link, Head } from "@inertiajs/inertia-vue3";
import AdminLayout from "../../Layouts/AdminLayout.vue";
import MostOrdered from "../../Components/MostOrdered.vue";
import MostTypeOfOrder from "../../Components/MostTypeOfOrder.vue";
import StatsCard from "../../Components/StatsCard.vue";
import OrderReport from "../../Components/OrderReport.vue";

export default {
    components: {
        Link,
        Head,
        AdminLayout,
        MostOrdered,
        MostTypeOfOrder,
        StatsCard,
        OrderReport,
    },
};
</script>
