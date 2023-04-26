<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    name: String,
    icon: String,
    href: String,
    active: String
});

</script>

<template>
    <Link :href="href" :class="{ 'bg-blue-900': active }"
            class="block hover:bg-blue-800 py-2.5 px-4 rounded-lg transition duration-200 w-full">
        <span class="inline-flex justify-center items-center ml-4">
            <span class="text-lg mdi" :class="icon"></span>
        </span>
        <span class="ml-2 text-sm tracking-wide truncate">{{ name }}</span>
        </Link>
</template>
