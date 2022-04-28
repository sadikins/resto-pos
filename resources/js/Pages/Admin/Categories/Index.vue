<script setup>
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Pagination from "../../../Components/Pagination.vue";
import OptionsIcon from "../../../Icons/OptionIcon.vue";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import OptionIcon from "../../../Icons/OptionIcon.vue";
import Button from "../../../Jetstream/Button.vue";

import Swal from "sweetalert2";
import SectionBorder from "../../../Jetstream/SectionBorder.vue";

const props = defineProps({
    categories: Object,
    tbl_number: Number,
});

// Search
const search = ref("" || new URL(document.location).searchParams.get("q"));

const handleSearch = () => {
    Inertia.get(route("categories.index"), {
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
            Inertia.delete(route("categories.destroy", `${id}`));

            Swal.fire({
                title: "Deleted!",
                text: "Category deleted successfully,",
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
                Categories
            </h2>
            <div class="text-gray-200">Tuesday 2 Feb, 2002</div>
        </template>

        <!-- Content -->
        <div class="p-10 bg-gray-900 rounded-lg">
            <div class="flex justify-between items-center pb-4 mt-5">
                <!-- Search bar -->
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
                        placeholder="search by category name..."
                    />
                </form>

                <!-- Button Create New  -->
                <Link
                    :href="route('categories.create')"
                    class="font-bold px-5 py-2 rounded-md hover:text-primary hover:border-2 hover:border-primary hover:bg-transparent bg-primary text-white"
                    >Create New
                </Link>
            </div>

            <!-- Table -->
            <table class="w-full mt-3">
                <thead>
                    <tr class="text-sm font-semibold text-white">
                        <td class="py-4 border-b border-gray-700">#</td>
                        <td class="py-4 border-b border-gray-700">Name</td>
                        <td class="py-4 border-b border-gray-700">
                            Description
                        </td>
                        <td class="py-4 border-b border-gray-700 text-center">
                            Action
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(category, key) in categories.data"
                        :key="key"
                        class="text-sm text-gray-500"
                    >
                        <td class="py-4">#</td>
                        <td class="py-4">
                            <div class="flex gap-4 items-center">
                                <img
                                    width="32"
                                    :src="`/storage/categories/${category.image}`"
                                    alt=""
                                />
                                <span class="text-white font-bold">
                                    {{ category.name }}
                                </span>
                            </div>
                        </td>
                        <td class="py-4">{{ category.description }}</td>
                        <td class="py-4 space-x-2 text-center">
                            <Link
                                as="button"
                                :href="
                                    route('categories.edit', `${category.id}`)
                                "
                                class="font-bold bg-accent-orange/20 py-2 px-3 text-accent-orange rounded-md"
                            >
                                Edit
                            </Link>
                            <button
                                @click.prevent="destroy(category.id)"
                                class="font-bold bg-accent-red/20 py-2 px-3 text-accent-red rounded-md"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mb-5 mt-7">
                <Pagination :links="categories.links" />
            </div>
        </div>

        <!-- End of Content -->

        <template #aside> </template>
    </AdminLayout>
</template>
