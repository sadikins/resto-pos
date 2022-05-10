<script setup>
defineProps({
    type: {
        type: String,
        default: "button",
    },
    class: {
        type: String,
    },
    href: {
        type: String,
    }
});
</script>

<template>
    <button
        :href="href"
        :type="type"
        class="inline-flex items-center px-4 py-2 border rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition"
        :class="class"
    >
        <slot />
    </button>
</template>
