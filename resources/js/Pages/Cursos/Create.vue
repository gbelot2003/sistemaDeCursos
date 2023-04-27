<script setup>
import AppLayout from '../../Layouts/AppLayout2.vue';
import { Head } from '@inertiajs/vue3';
import Formvue from './partials/CreateForm.vue'

</script>

<template>
    <Head title="Edición de Cursos" />
    <AppLayout>
        <div class="container">
            <h1 class="text-lg">Creación de Cursos</h1>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <Formvue></Formvue>
            </div>
        </div>
    </AppLayout>
</template>
