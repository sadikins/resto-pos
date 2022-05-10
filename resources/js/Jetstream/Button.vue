<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
    class: {
        type: String,
       
    },
    href:{
        type: String,
    }
});
</script>

<template>
    <button
        :href="href"
        :type="type"
        class="inline-flex text-white items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
        :class="class"
    >
        <slot />
    </button>
</template>
