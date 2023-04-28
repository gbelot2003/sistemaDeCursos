<script setup>
import AppLayout from '../../Layouts/AppLayout2.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    student: {
        type: Object
    }
});

let cursos = ref(props.student.cursos)
</script>

<template>
    <Head title="Cursos" />
    <AppLayout>
        <div class="container">
            <h1 class="text-3xl mb-5"><span class="font-bold text-gray-600 ">{{ props.student.nombre }}</span></h1>

            <div class="grid grid-cols-1 md:grid-cols-2 bg-gray-50 py-5 px-3">
                <div>
                    <h2 class="text-2xl mb-5">Detalles de Estudiante</h2>
                    <div class="col-span-6 sm:col-span-4 mb-2 text-2xl">
                        <span class="text-gray-500">Nombre: </span>{{ props.student.nombre }}
                    </div>

                    <div class="col-span-6 sm:col-span-4 mb-2 text-2xl">
                        <span class="text-gray-500">Horario: </span>{{ props.student.apellido }}
                    </div>

                    <div class="col-span-6 sm:col-span-4 mb-2 text-2xl">
                        <span class="text-gray-500">Fecha de Inicio: </span>{{ props.student.edad }}
                    </div>

                    <div class="col-span-6 sm:col-span-4 mb-2 text-2xl">
                        <span class="text-gray-500">Fecha Final: </span>{{ props.student.email }}
                    </div>
                </div>
                <div>
                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                        <div v-if="cursos.length" class="md:grid md:grid-cols-3 md:gap-6 mb-7">
                            <h2 class="text-2xl">Listado de Cursos Asignados</h2>
                            <div v-for="curso in cursos" :key="curso.id" class="col-span-6 sm:col-span-4 ">
                                <div class="border bg-gray-200 p-5">
                                    <p>Nombre: {{ curso.nombre }}</p>
                                    <p>Horario: {{ curso.horario }}</p>
                                    <p>Fecha Inicio: {{ curso.inicio }}</p>
                                    <p>Fecha Final: {{ curso.final }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
