<script setup>
import AppLayout from '../../Layouts/AppLayout2.vue';
import { Head } from '@inertiajs/vue3';
import Formvue from './partials/CreateForm.vue'

const props = defineProps({
    cursos: {
        type: Array
    }
})
</script>

<template>
    <Head title="Edición de Estudiantes" />
    <AppLayout>
        <div class="container">
            <h1 class="text-lg">Creación de estudiantes</h1>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <Formvue :cursos="cursos"></Formvue>
            </div>
        </div>
    </AppLayout>
</template>
