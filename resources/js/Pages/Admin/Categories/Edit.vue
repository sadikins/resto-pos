<template>
    <AdminLayout>
        <template #title>
            <h2 class="text-3xl font-semibold leading-loose text-white">
                Edit Categories
            </h2>
            <div class="text-gray-200">Tuesday 2 Feb, 2002</div>
        </template>
        <!--Content  -->
        <div class="container w-1/2 bg-gray-900 rounded-md p-8">
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
                    <img
                        width="100"
                        :src="`/storage/categories/${category.image}`"
                        :alt="`${category.image}`"
                    />
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
                    <label for="name" class="text-white mb-5">Name</label>
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
                <div class="mb-5">
                    <label for="descritption" class="text-white mb-5"
                        >Description</label
                    >
                    <textarea
                        rows="10"
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.description"
                        :class="{ 'is-invalid': errors.description }"
                        placeholder="Category description"
                    ></textarea>

                    <div v-if="errors.description" class="text-accent-red">
                        {{ errors.description }}
                    </div>
                </div>
                <div class="mb-3">
                    <ButtonPrimary
                        :class="`mb-3 font-bold text-center  w-full bg-primary border-primary hover:text-primary text-white py-3`"
                    >
                        UPDATE
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

<script>
import { Inertia } from "@inertiajs/inertia";
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";
import ButtonPrimary from "../../../Jetstream/Button.vue";

export default {
    props: {
        errors: Object,
        category: Object,
    },
    components: {
        AdminLayout,
        Link,
        ButtonPrimary,
    },

    setup(props) {
        const form = reactive({
            name: props.category.name,
            description: props.category.description,
            image: "",
        });

        const submit = () => {
            Inertia.post(route("categories.update", `${props.category.id}`), {
                _method: "PUT",
                name: form.name,
                description: form.description,
                image: form.image,
            });
        };

        return {
            form,
            submit,
        };
    },
};
</script>
