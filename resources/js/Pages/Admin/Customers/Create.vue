<template>
    <AdminLayout>
        <template #title>
            <h2 class="text-3xl font-semibold leading-loose text-white">
                Create Customers
            </h2>
            <div class="text-gray-200">Tuesday 2 Feb, 2002</div>
        </template>
        <!-- Content -->
        <div class="container sm:w-full lg:w-1/2 bg-gray-900 rounded-md p-8">
            <form @submit.prevent="submit">
                <Link
                    href="/admin/customers"
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
                    <label for="name" class="text-white mb-3">Name</label>
                    <input
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.name"
                        :class="{ 'is-invalid': errors.name }"
                        placeholder="customer Name"
                    />
                    <div v-if="errors.name" class="text-accent-red">
                        {{ errors.name }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="text-white mb-3">phone</label>
                    <input
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.phone"
                        :class="{ 'is-invalid': errors.phone }"
                        placeholder="customer phone number"
                    />
                    <div v-if="errors.phone" class="text-accent-red">
                        {{ errors.phone }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="text-white mb-3"
                        >address</label
                    >
                    <textarea
                        rows="10"
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.address"
                        :class="{ 'is-invalid': errors.address }"
                        placeholder="customer address"
                    >
                    </textarea>
                    <div v-if="errors.address" class="text-accent-red">
                        {{ errors.address }}
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
    phone: "",
    address: "",
});

const submit = () => {
    Inertia.post(
        route("customers.store"),
        {
            name: form.name,
            phone: form.phone,
            address: form.address,
        },
        {
            onSuccess: () => {
                Swal.fire({
                    title: "Success",
                    text: "customer saved successfully.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000,
                });
            },
        }
    );
};
</script>
