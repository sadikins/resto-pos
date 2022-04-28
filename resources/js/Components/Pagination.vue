<template>
    <div>
        <Component
            :is="link.url ? 'Link' : 'span'"
            v-for="(link, index) in links"
            :key="index"
            :href="link.url"
            v-html="link.label"
            class="px-3 py-2 font-bold mr-1 text-gray-500"
            :class="{
                'text-gray-700': !link.url,
                '!text-primary/70': link.active,
            }"
        />
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    props: {
        links: Array,
    },
    components: {
        Link,
    },
};
</script>
