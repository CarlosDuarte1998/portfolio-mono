<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import EditProject from "@/Components/Forms/project/EditProject.vue";
import { ref, onMounted } from "vue";
import { router, usePage, Link  } from '@inertiajs/vue3'



const page = usePage();


const props = defineProps({
    project: Object,
});

const hasRecords = ref(new Boolean(props.project.hasRecords).valueOf());


onMounted(async () => {
    if (new Boolean(props.project.hasRecords)==false) {
        router.visit('/projects');
    }
});






</script>

<template>

    <Head title="Projects" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a href="/projects">Proyecto</a> > Editar
            </h2>
        </template>

        <div class="py-6" v-if="hasRecords">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <EditProject :project="props.project" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
tbody::hover {
    background-color: #f5f5f5;
}
</style>

