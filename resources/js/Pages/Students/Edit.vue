<script setup>
import AppLayout from '../../Layouts/AppLayout2.vue';
import { Head } from '@inertiajs/vue3';
import Formvue from './partials/EditForm.vue'

const props = defineProps({
    student: {
        type: Object
    },
    cursos: {
        type: Array
    }
});

</script>

<template>
    <Head title="Edición de Estudiante" />
    <AppLayout>
        <div class="container">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <Formvue :student="student" :cursos="cursos" ></Formvue>
            </div>
        </div>
    </AppLayout>
</template>
