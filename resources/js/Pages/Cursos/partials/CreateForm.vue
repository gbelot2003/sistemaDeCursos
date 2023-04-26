<script setup>
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

let form = useForm({
    nombre: '',
    horario: '',
    inicio: '',
    final: ''
})

</script>

<template>
    <div class="md:grid md:grid-cols-3 md:gap-6 mb-7">
        <div class="md:col-span-1 flex justify-between">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900">Datos De Curso</h3>
                <p class="mt-1 text-sm text-gray-600">Creación de Nuevo Curso</p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form @submit.prevent="submit">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6 sm:col-span-4">
                            <label for="nombre">Nombre</label>
                            <input v-model="form.nombre" id="nombre"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                :class="{ 'border-red-500': form.errors.nombre }" type="text">
                            <div class="text-red-600" v-if="form.errors.nombre">{{ form.errors.nombre }}</div>
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <label for="nombre">Horario</label>
                            <VueDatePicker v-model="form.horario" time-picker></VueDatePicker>
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <label for="nombre">Fecha de Inicio</label>
                            <VueDatePicker v-model="form.inicio"></VueDatePicker>
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <label for="nombre">Fecha de Final</label>
                            <VueDatePicker v-model="form.final"></VueDatePicker>
                        </div>

                    </div>
                </div>
                <div
                    class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
