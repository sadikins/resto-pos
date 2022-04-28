<script setup>
import { onMounted, ref } from "vue";

defineProps({
    modelValue: String,
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        :value="modelValue"
        class="border-gray-700 focus:border-gray-500 focus:ring focus:ring-gray-100 focus:ring-opacity-50 rounded-md shadow-sm bg-gray-700 py-3 text-gray-100"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>
