<script setup>
import AppLayout from '../../Layouts/AppLayout2.vue';
import Pagination from '../../Components2/Pagination.vue'
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import { ref, watch } from "vue";
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    students: Object,
    filters: Object
});

let search = ref(props.filters.search);

watch(search, value => {
    router.get('/estudiantes', { search: value }, { preserveState: true })
})

</script>

<template>
    <Head title="Administración de Estudiantes" />
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Administración de Estudiantes</h2>
        </template>

        <div class="container">
            <h1 class="text-lg mb-10">Administración de estudiantes</h1>
            <div class="md:flex md:justify-between mb-2">
                <Link href="estudiantes/create"
                    class="leading-tight py-3 px-2 text-white rounded-full text-center bg-blue-950">Nuevo <span
                    class="mdi mdi-plus-circle-outline"></span></Link>
                <input type="text" class="rounded w-full md:w-1/2" v-model="search" placeholder="Buscar...." />
            </div>

            <div class="container text-base">
                <table class="w-full flex flex-row flex-nowrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                    <thead class="text-white">
                        <tr class="bg-blue-400 flex flex-col flex-nowrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
                            v-for="students in students.data" :key="students.id">
                            <th class="p-3 text-left">ID</th>
                            <th class="p-3 text-left">Nombre</th>
                            <th class="p-3 text-left">Apellido</th>
                            <th class="p-3 text-left">edad</th>
                            <th class="p-3 text-left">email</th>
                            <th class="p-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="flex-1 sm:flex-none">
                        <tr class="flex flex-col flex-nowrap sm:table-row mb-2 sm:mb-0" v-for="students in students.data"
                            :key="students.id">
                            <td class="border-grey-light md:border hover:bg-gray-100 p-4">{{ students.id }}</td>
                            <td class="border-grey-light md:border hover:bg-gray-100 p-3">{{ students.nombre }}</td>
                            <td class="border-grey-light md:border hover:bg-gray-100 p-3">{{ students.apellido }}</td>
                            <td class="border-grey-light md:border hover:bg-gray-100 p-3">{{ students.edad }}</td>
                            <td class="border-grey-light md:border hover:bg-gray-100 p-3">{{ students.email }}</td>
                            <td class="border-grey-light md:border hover:bg-gray-100 p-3">
                                <Link :href="`estudiantes/${students.id}/edit`"
                                    class="bg-blue-700 hover:bg-blue-400 px-3 py-2 mr-2 rounded-lg text-white hover:underline">
                                Edit
                                </Link>
                                <Link :href="`estudiantes/${students.id}`"
                                    class="bg-red-700 hover:bg-blue-400 px-3 py-2 mr-2 rounded-lg text-white hover:underline">
                                Show
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination :links="students.links" />
            </div>
        </div>

    </AppLayout>
</template>

<style>
@media (min-width: 640px) {
    table {
        display: inline-table !important;
    }

    thead tr:not(:first-child) {
        display: none;
    }
}

td:not(:last-child) {
    border-bottom: 0;
}

th:not(:last-child) {
    border-bottom: 2px solid rgba(0, 0, 0, .1);
}
</style>
