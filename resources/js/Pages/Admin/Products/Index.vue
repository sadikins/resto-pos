<script setup>
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import Pagination from '@/Components/Pagination.vue';
    import ButtonLink from "@/Components/ButtonLink.vue";
    import {Link} from '@inertiajs/inertia-vue3';
    import {ref} from 'vue';
    import Swal from 'sweetalert2';
import { Inertia } from '@inertiajs/inertia';

    const props = defineProps({
        'products': Object,
    });

    const search = ref("" || new URL(document.location).searchParams.get("q"));

const handleSearch = () => {
    Inertia.get(route("products.index"), {
        q: search.value,
    });
};

// Destroy
const destroy = (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FF7CA3",
        cancelButtonColor: "#ABBBC2",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            Inertia.delete(route("products.destroy", `${id}`));

            Swal.fire({
                title: "Deleted!",
                text: "Product deleted successfully,",
                icon: "success",
                timer: 2000,
                showConfirmButton: false,
            });
        }
    });
};

</script>

<template>

    <AdminLayout>

        <template #title>
             <h2 class="text-3xl font-semibold leading-loose text-white">
                Products
            </h2>
            <div class="text-gray-200">Tuesday 2 Feb, 2002</div>
        </template>

        <!-- content -->

          <div class="p-5 md:p-10 bg-gray-900 rounded-lg">

            <!-- Search bar -->
            <div class="flex flex-col md:flex-row  gap-3 md:gap-0 justify-between pb-4 mt-5">
                <form
                    @submit.prevent="handleSearch"
                    class="flex justify-center bg-gray-700 rounded-lg px-5"
                >
                    <!-- Icon search -->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-gray-500 mt-3 mr-3"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>
                    <input
                        type="text"
                        class="py-3 bg-transparent border-0 text-white focus:ring-0"
                        v-model="search"
                        placeholder="search by product name..."
                    />
                </form>

                <!-- Button Create New  -->
                <ButtonLink
                :href="route('products.create')"
                :class="`bg-primary  text-white`"
                >Create New
                </ButtonLink>
            </div>

            <!-- Table -->
            <table class="sm:w-full mt-3">
                <thead>
                    <tr class="text-sm font-semibold text-white">
                        <td class="py-4 border-b border-gray-700">#</td>
                        <td class="py-4 border-b border-gray-700">Barcode</td>
                        <td class="py-4 border-b border-gray-700">Title</td>
                        <td class="py-4 border-b border-gray-700">By Price</td>
                        <td class="py-4 border-b border-gray-700">Sell Price</td>
                        <td class="py-4 border-b border-gray-700">Stock</td>
                        <td class="py-4 border-b border-gray-700 text-center">
                            Action
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(product, key) in products.data"
                        :key="key"
                        class="text-sm text-gray-500"
                    >
                        <td class="py-4">#</td>
                        <td class="py-4">
                            <div class="flex gap-4 items-center">
                                <img
                                    width="32"
                                    :src="product.image"
                                    alt=""
                                    class="hidden md:block"
                                />
                                <span class="text-white font-bold">
                                    {{ product.barcode }}
                                </span>
                            </div>
                        </td>
                        <td class="py-4">{{ product.title }}</td>
                        <td class="py-4">{{ product.buy_price }}</td>
                        <td class="py-4">{{ product.sell_price }}</td>
                        <td class="py-4">{{ product.stock }}</td>
                        <td class="py-4 space-x-2 text-center">
                            <ButtonLink
                                :href="
                                    route('products.edit', `${product.id}`)
                                "
                                :class="` md:bg-accent-orange/20  text-accent-orange`"
                            >
                                Edit
                            </ButtonLink>
                            <ButtonLink
                                @click.prevent="destroy(product.id)"
                                :class="` md:bg-accent-red/20  text-accent-red`"
                            >
                                Delete
                            </ButtonLink>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mb-5 mt-7">
                <Pagination :links="products.links" />
            </div>
        </div>

        <template #aside>

        </template>


    </AdminLayout>

</template>