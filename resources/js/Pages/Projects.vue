<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import AddProject from "@/Components/Forms/project/AddProjects.vue";
import { ref, onMounted } from "vue";
import axios from "axios";
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import { router, usePage  } from '@inertiajs/vue3'

const page = usePage();
let projects = ref([]);
let showModal = ref(false);



onMounted(async () => {
    const response = await axios.get(route("projects.index"));
    projects.value = response.data;
});

const openModal = (data) => {
    showModal.value = true;
    projectSelect = data;
};


const props = defineProps({
    project: Object,
});

const updateRegister = (dataSelect) => {
    router.visit('/projects/edit', dataSelect);
};

</script>

<template>

    <Head title="Projects" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Proyectos
            </h2>
        </template>
        <div class="py-6" v-if="
        page.url=='/projects'
        ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                                <thead class="ltr:text-left rtl:text-right">
                                    <tr class="font-medium text-gray-900 whitespace-nowrap">
                                        <th class=" px-4 py-2 ">
                                            Nombre
                                        </th>
                                        <th class=" px-4 py-2 ">
                                            Descripción
                                        </th>
                                        <th class=" px-4 py-2 ">
                                            Fecha de inicio
                                        </th>
                                        <th class="px-4 py-2">
                                            Fecha final
                                        </th>

                                        <th class=" px-4 py-2 ">
                                            Imagen
                                        </th>
                                    </tr>
                                </thead>

                                <template v-for="(project, index) in projects">
                                    <tbody class="divide-y-2 divide-gray-200" @click.prevent="updateRegister(project)">
                                        <tr class="" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
                                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
                                                {{ project.name }}
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-2 text-gray-700 ">
                                                {{ project.description }}
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                                {{ project.start_date }}
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                                {{ project.end_date }}
                                            </td>
                                            <td class="whitespace-nowrap  px-4 py-2 text-gray-700">
                                                <img :src="'http://portfolio-mono.test/storage/' + project.image"
                                                    :alt="project.name" class="w-10 h-10 rounded-full"
                                                    v-if="project.image" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </template>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <pre>{{
                            props.project
                            }}</pre>
                        <AddProject />
                    </div>
                </div>
            </div>
        </div>
        <Modal :show="showModal">
            <div class="px-3 py-5">
                <div class="w-full justify-between flex gap-3">
                    <div>
                        <SecondaryButton @click="closeModal" class="bg-blue-500 text-white hover:bg-blue-400"> Editar </SecondaryButton>
                        <DangerButton class="ms-3 ">
                            Borrar registro
                        </DangerButton>
                    </div>
                    <button class="bg-gray-500 text-white px-3 py-1 text-lg rounded-lg"
                        @click="showModal = false">Cerrar</button>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>

<style scoped>
tbody::hover {
    background-color: #f5f5f5;
}
</style>import { data } from "autoprefixer";

