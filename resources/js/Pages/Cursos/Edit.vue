<script setup>
import AppLayout from '../../Layouts/AppLayout2.vue';
import { Head } from '@inertiajs/vue3';
import Formvue from './partials/EditForm.vue'

const props = defineProps({
    curso: {
        type: Object
    }
});

</script>

<template>
    <Head title="Edición de Cursos" />
    <AppLayout>
        <div class="container">
            <h1 class="text-lg">Edición de Cursos</h1>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <Formvue :curso="curso"></Formvue>
            </div>
        </div>
    </AppLayout>
</template>
