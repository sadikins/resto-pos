<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    href: String,
    active: Boolean,
    method: String,
    permission: String,
});

const classes = computed(() => {
    return props.active
        ? "text-white shadow-primary bg-primary"
        : "text-primary";
});
</script>

<template>
    <Link
        as="button"
        :href="href"
        :class="classes"
        :method="method"
        :permission="permission"
        class="p-4 my-4 mr-4 ml-3 rounded-xl block"
    >
        <slot />
    </Link>
</template>
