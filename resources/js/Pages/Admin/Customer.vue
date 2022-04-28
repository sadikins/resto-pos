<template>
    <AdminLayout title="Customer">
        <template #title>
            <h2 class="text-3xl font-semibold leading-loose text-white">
                Customer
            </h2>
            <div class="text-gray-200">Tuesday 2 Feb, 2002</div>
        </template>

        <!-- Content -->
        <!-- Modals -->
        <div>
            <button
                class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                type="button"
                v-on:click="toggleModal()"
            >
                Open small modal
            </button>
            <div
                v-if="showModal"
                class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex"
            >
                <div class="relative w-auto my-6 mx-auto max-w-sm">
                    <!--content-->
                    <div
                        class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none"
                    >
                        <!--header-->
                        <div
                            class="flex items-start justify-between p-5 border-b border-solid border-blueGray-200 rounded-t"
                        >
                            <h3 class="text-3xl font-semibold">Modal Title</h3>
                            <button
                                class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                                v-on:click="toggleModal()"
                            >
                                <span
                                    class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none"
                                >
                                    ×
                                </span>
                            </button>
                        </div>
                        <!--body-->
                        <div class="relative p-6 flex-auto">
                            <p
                                class="my-4 text-blueGray-500 text-lg leading-relaxed"
                            >
                                I always felt like I could do anything. That’s
                                the main thing people are controlled by!
                                Thoughts- their perception of themselves!
                                They're slowed down by their perception of
                                themselves. If you're taught you can’t do
                                anything, you won’t do anything. I was taught I
                                could do everything.
                            </p>
                        </div>
                        <!--footer-->
                        <div
                            class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b"
                        >
                            <button
                                class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button"
                                v-on:click="toggleModal()"
                            >
                                Close
                            </button>
                            <button
                                class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button"
                                v-on:click="toggleModal()"
                            >
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div
                v-if="showModal"
                class="opacity-25 fixed inset-0 z-40 bg-black"
            ></div>
        </div>

        <!-- End of Modal -->

        <!-- Tooltip -->

        <div class="flex flex-wrap">
            <div class="w-full text-center">
                <button
                    ref="btnRef"
                    v-on:mouseenter="toggleTooltip()"
                    v-on:mouseleave="toggleTooltip()"
                    class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                    type="button"
                >
                    left emerald
                </button>
                <div
                    ref="popoverRef"
                    v-bind:class="{ hidden: !popoverShow, block: popoverShow }"
                    class="bg-emerald-600 border-0 mr-3 block z-50 font-normal leading-normal text-sm max-w-xs text-left no-underline break-words rounded-lg"
                >
                    <div>
                        <div
                            class="bg-emerald-600 text-white opacity-75 font-semibold p-3 mb-0 border-b border-solid border-blueGray-100 uppercase rounded-t-lg"
                        >
                            emerald tooltip title
                        </div>
                        <div class="text-white p-3">
                            And here's some amazing content. It's very engaging.
                            Right?
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Tooltip -->
        <!-- End of Content -->

        <template #aside>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere,
                minus ratione dicta numquam dolorem velit sed repellendus,
                nulla, voluptates laboriosam placeat ipsam vitae? Saepe
                perspiciatis enim sit illum voluptatibus velit!
            </p>
        </template>
    </AdminLayout>
</template>

<script>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { createPopper } from "@popperjs/core";

export default {
    components: { AdminLayout },

    data() {
        return {
            showModal: false,
            popoverShow: false,
        };
    },
    methods: {
        toggleModal: function () {
            this.showModal = !this.showModal;
        },
        toggleTooltip: function () {
            if (this.popoverShow) {
                this.popoverShow = false;
            } else {
                this.popoverShow = true;
                createPopper(this.$refs.btnRef, this.$refs.popoverRef, {
                    placement: "left",
                });
            }
        },
    },
};
</script>
