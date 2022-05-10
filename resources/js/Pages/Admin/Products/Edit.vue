<template>
    <AdminLayout>
        <template #title>
            <h2 class="text-3xl font-semibold leading-loose text-white">
                Edit products
            </h2>
            <div class="text-gray-200">Tuesday 2 Feb, 2002</div>
        </template>
        <!--Content  -->
        <div class="container sm:w-full lg:w-1/2 bg-gray-900 rounded-md p-8">
            <form @submit.prevent="submit">
                <Link
                    href="/admin/products"
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
                        :src="product.image"
                        :alt="`${product.image}`"
                    />
                    <input
                        class="py-3 text-gray-300"
                        @input="form.image = $event.target.files[0]"
                        :class="{ 'border-accent-red': errors.image }"
                        type="file"
                    />
                    <div v-if="errors.image" class="text-accent-red">
                        {{ errors.image }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="barcode" class="text-white mb-5">Barcode</label>
                    <input
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.barcode"
                        :class="{ 'border-accent-red': errors.barcode }"
                        placeholder="product barcode"
                    />
                    <div v-if="errors.barcode" class="text-accent-red">
                        {{ errors.barcode }}
                    </div>
                </div>

                <div class="mb-3">
                    <label for="category" class="text-white mb-5">Category</label>
                    <select v-model="form.category_id" class="px-3 text-gray-300 rounded-md bg-gray-700 w-full" :class="{'border-accent-red': errors.category_id }">
                        <option v-for="(category, index) in categories" :key="index" :value="category.id">{{ category.name }}</option>
                    </select>

                    <div v-if="errors.category_id" :class="`text-accent-red`">
                        {{ errors.category_id }}
                    </div>
                </div>


                <div class="mb-3">
                    <label for="title" class="text-white mb-5">Title</label>
                    <input
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.title"
                        :class="{ 'border-accent-red': errors.title }"
                        placeholder="product title"
                    />
                    <div v-if="errors.title" class="text-accent-red">
                        {{ errors.title }}
                    </div>
                </div>
           
                <div class="mb-5">
                    <label for="descritption" class="text-white mb-5"
                        >Description</label
                    >
                    <textarea
                        rows="5"
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.description"
                        :class="{ 'border-accent-red': errors.description }"
                        placeholder="product description"
                    ></textarea>

                    <div v-if="errors.description" class="text-accent-red">
                        {{ errors.description }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="buy_price" class="text-white mb-5">buy_price</label>
                    <input
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.buy_price"
                        :class="{ 'border-accent-red': errors.buy_price }"
                        placeholder="product buy_price"
                    />
                    <div v-if="errors.buy_price" class="text-accent-red">
                        {{ errors.buy_price }}
                    </div>
                </div>

                <div class="mb-3">
                    <label for="sell_price" class="text-white mb-5">sell_price</label>
                    <input
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.sell_price"
                        :class="{ 'border-accent-red': errors.sell_price }"
                        placeholder="product sell_price"
                    />
                    <div v-if="errors.sell_price" class="text-accent-red">
                        {{ errors.sell_price }}
                    </div>
                </div>

                <div class="mb-3">
                    <label for="stock" class="text-white mb-5">stock</label>
                    <input
                        type="text"
                        class="px-3 text-gray-300 rounded-md bg-gray-700 w-full"
                        v-model="form.stock"
                        :class="{ 'border-accent-red': errors.stock }"
                        placeholder="product stock"
                    />
                    <div v-if="errors.stock" class="text-accent-red">
                        {{ errors.stock }}
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
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";
import ButtonPrimary from "@/Jetstream/Button.vue";

export default {
    props: {
        errors: Object,
        product: Object,
        categories: Array,
    },
    components: {
        AdminLayout,
        Link,
        ButtonPrimary,
    },

    setup(props) {
        const form = reactive({
            image: "",
            barcode: props.product.barcode,
            category_id: props.product.category_id,
            title: props.product.title,
            description: props.product.description,
            buy_price: props.product.buy_price,
            sell_price: props.product.sell_price,
            stock: props.product.stock,
        });

        const submit = () => {
            Inertia.post(route("products.update", `${props.product.id}`), {
                _method: "PUT",
                image: form.image,
                barcode: form.barcode,
                category_id: form.category_id,
                title: form.title,
                description: form.description,
                buy_price: form.buy_price,
                sell_price: form.sell_price,
                stock: form.stock,
            });
        };

        return {
            form,
            submit,
        };
    },
};
</script>
