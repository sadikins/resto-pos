<script setup>
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    href: String,
    classes: String,

});

</script>

<template>
    <Link as="button" :href="href" :class="classes" class="md:font-bold md:py-2 md:px-3 rounded-md">  
        <slot/>
    </Link>
    
</template>