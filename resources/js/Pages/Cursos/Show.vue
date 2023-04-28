<script setup>
import AppLayout from '../../Layouts/AppLayout2.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    curso: {
        type: Object
    },
    students: {
        type: Object
    }
});

let students = ref(props.curso.students)

</script>

<template>
    <Head title="Cursos" />
    <AppLayout>
        <div class="container">
            <h1 class="text-3xl mb-5">Curso <span class="font-bold text-gray-600 ">{{ props.curso.nombre }}</span></h1>

            <div class="grid grid-cols-1 md:grid-cols-2 bg-gray-50 py-5 px-3">
                    <div>
                        <h2 class="text-2xl mb-5">Detalles de la Clase</h2>
                        <div class="col-span-6 sm:col-span-4 mb-2 text-2xl">
                            <span class="text-gray-500">Nombre: </span>{{ props.curso.nombre }}
                        </div>

                        <div class="col-span-6 sm:col-span-4 mb-2 text-2xl">
                            <span class="text-gray-500">Horario: </span>{{ props.curso.horario }}
                        </div>

                        <div class="col-span-6 sm:col-span-4 mb-2 text-2xl">
                            <span class="text-gray-500">Fecha de Inicio: </span>{{ props.curso.inicio }}
                        </div>

                        <div class="col-span-6 sm:col-span-4 mb-2 text-2xl">
                            <span class="text-gray-500">Fecha Final: </span>{{ props.curso.final }}
                        </div>
                    </div>
                    <div>
                        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                            <div class="md:grid md:grid-cols-3 md:gap-6 mb-7">
                                <h2 class="text-2xl">Listado de estudiantes</h2>
                                <div v-for="students in students" :key="students.id" class="col-span-6 sm:col-span-4 ">
                                    <div class="border bg-gray-200 p-5">
                                        <p>Nombre: {{ students.nombre }}</p>
                                        <p>Apellido: {{ students.apellido }}</p>
                                        <p>Edad: {{ students.edad }}</p>
                                        <p>Email: {{ students.email }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
        </div>
    </AppLayout>
</template>
