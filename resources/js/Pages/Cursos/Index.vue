<script setup>
import AppLayout from '../../Layouts/AppLayout2.vue';
import Pagination from '../../Components2/Pagination.vue'
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import { ref, watch } from "vue";
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    cursos: Object,
    filters: Object
});

let search = ref(props.filters.search);

watch(search, value => {
    router.get('/cursos', { search: value }, { preserveState: true })
})

</script>

<template>
    <Head title="Administración de Cursos" />
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Administración de Cursos</h2>
        </template>

        <div class="container">
            <div class="md:flex md:justify-between mb-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight py-3 text-center">Administración de Cursos
                </h2>
                <input type="text" class="rounded w-full md:w-1/2" v-model="search" placeholder="Buscar...." />
            </div>

            <div class="container text-base">
                <table class="w-full flex flex-row flex-nowrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
                    <thead class="text-white">
                        <tr class="bg-blue-400 flex flex-col flex-nowrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0"
                            v-for="cursos in cursos.data" :key="cursos.id">
                            <th class="p-3 text-left">ID</th>
                            <th class="p-3 text-left">Nombre</th>
                            <th class="p-3 text-left">Horario</th>
                            <th class="p-3 text-left">Inicio</th>
                            <th class="p-3 text-left">Final</th>
                            <th class="p-3 text-left">Alumnos</th>
                        </tr>
                    </thead>
                    <tbody class="flex-1 sm:flex-none">
                        <tr class="flex flex-col flex-nowrap sm:table-row mb-2 sm:mb-0" v-for="cursos in cursos.data"
                            :key="cursos.id">
                            <td class="border-grey-light md:border hover:bg-gray-100 p-3">{{ cursos.id }}</td>
                            <td class="border-grey-light md:border hover:bg-gray-100 p-3">{{ cursos.nombre }}</td>
                            <td class="border-grey-light md:border hover:bg-gray-100 p-3">{{ cursos.horario }}</td>
                            <td class="border-grey-light md:border hover:bg-gray-100 p-3">{{ cursos.inicio }}</td>
                            <td class="border-grey-light md:border hover:bg-gray-100 p-3">{{ cursos.final }}</td>
                            <td class="border-grey-light md:border hover:bg-gray-100 p-3">5</td>
                        </tr>
                    </tbody>
                </table>
                <Pagination :links="cursos.links" />
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
