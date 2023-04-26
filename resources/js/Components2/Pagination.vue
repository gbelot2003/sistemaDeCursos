<script setup>
import { Link } from '@inertiajs/vue3'
const props = defineProps({
    links: Object,
});

</script>

<template>
    <div class="max-w-2xl mt-5 mb-5 ml-5">
        <nav aria-label="Page navigation example">
            <ul class="inline-flex w-space-x-px">
                <li v-for="link in links" :key="link.url">
                    <Link :href="link.url" class="text-xs md:px-3 md:py-2 md:text-base" :class="{
                        'bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 ml-0 rounded-l-lg leading-tight py-1 px-2 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white': ! link.url,
                        'bg-blue-50 border border-gray-300 text-blue-600 hover:bg-blue-100 hover:text-blue-700  py-1 px-2 dark:border-gray-700 dark:bg-gray-700 dark:text-white': link.active,
                        'bg-white border border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700 leading-tight py-1 px-2 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white': link.url
                    }" v-html="link.label"></Link>
                </li>
            </ul>
        </nav>
    </div>
</template>
