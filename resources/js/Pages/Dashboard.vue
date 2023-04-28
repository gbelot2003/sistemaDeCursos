<script setup>
import AppLayout from '@/Layouts/AppLayout2.vue';

const props = defineProps({
    query: Object,
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <h2 class="text-3xl mb-2 p-5">Cursos Distiguidosen los ultimos 6 Meses</h2>
                    <div class="p-5 grid grid-cols-1 md:grid-cols-3">
                        <div class="mr-2 mb-5 border p-2" v-for="data in props.query" :key="data.id">
                            <p class="text-2xl"><span class="text-gray-800">Nombre de Clase</span>: <span
                                    class="text-blue-500">{{ data.nombre
                                    }}</span></p>
                            <p>
                                <span class="text-2xl">Alumnos: </span>
                                <span class="text-red-500 text-2xl">
                                    {{ data.total_estudiantes }}
                                </span>
                            </p>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
