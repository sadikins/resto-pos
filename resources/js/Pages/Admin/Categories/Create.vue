<template>
    <AdminLayout>
        <template #title>
            <h2 class="text-3xl font-semibold leading-loose text-white">
                Create Categories
            </h2>
            <div class="text-gray-200">Tuesday 2 Feb, 2002</div>
        </template>
        <!-- Content -->
        <div class="container sm:w-full lg:w-1/2 bg-gray-900 rounded-md p-8">
            <form @submit.prevent="submit">
                <Link
                    href="/admin/categories"
                    class="flex justify-end text-gray-500"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </Link>
                <div class="mb-3">
                    <input
                        class="py-3 text-gray-300"
                        @input="form.image = $event.target.files[0]"
                        :class="{ 'is-invalid': errors.image }"
                        type="file"
                    />
                    <div v-if="errors.image" class="text-accent-red">
                        {{ errors.image }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="text-white mb-3">Name</label>
                    <input
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.name"
                        :class="{ 'is-invalid': errors.name }"
                        placeholder="Category Name"
                    />
                    <div v-if="errors.name" class="text-accent-red">
                        {{ errors.name }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="text-white mb-3"
                        >Description</label
                    >
                    <textarea
                        rows="10"
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.description"
                        :class="{ 'is-invalid': errors.description }"
                        placeholder="Category Description"
                    >
                    </textarea>
                    <div v-if="errors.description" class="text-accent-red">
                        {{ errors.description }}
                    </div>
                </div>
                <div class="mt-5">
                    <ButtonPrimary
                        :class="`mb-3 font-bold text-center  w-full bg-primary border-primary hover:text-primary text-white py-3`"
                    >
                        SAVE
                    </ButtonPrimary>

                    <ButtonPrimary
                        :type="`reset`"
                        :class="`w-full font-bold text-gray-300 py-3`"
                    >
                        RESET
                    </ButtonPrimary>
                </div>
            </form>
        </div>
        <!-- End of Content -->
        <template #aside> </template>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import Swal from "sweetalert2";

import ButtonPrimary from "../../../Jetstream/Button.vue";

defineProps({
    errors: Object,
});

const form = reactive({
    name: "",
    image: "",
    description: "",
});

const submit = () => {
    Inertia.post(
        route("categories.store"),
        {
            name: form.name,
            image: form.image,
            description: form.description,
        },
        {
            onSuccess: () => {
                Swal.fire({
                    title: "Success",
                    text: "Category saved successfully.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000,
                });
            },
        }
    );
};
</script>
