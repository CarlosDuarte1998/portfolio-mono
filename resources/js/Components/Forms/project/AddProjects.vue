<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import TextInput from '@/Components/TextInput.vue';

const image = ref(null);
const form = useForm({
    name: '',
    description: '',
    start_date: '',
    end_date: '',
    image: null,
});

const handleFileUpload = (event) => {
        form.image = event.target.files[0];
    };


const submit = () => {
        form.post(route('projects.store'), {
            preserveScroll: true,
            onSuccess: () => {
                form.image = null;
                form.name = '';
                form.description = '';
                form.start_date = '';
                form.end_date = '';
            },
        });
};
</script>

<template>
    <section>
        <form @submit.prevent="submit" method="post" class=" sm:max-w-xl" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                <TextInput id="name" v-model="form.name" name="name" class="form-input w-full" />
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Descripción</label>
                <textarea id="description" v-model="form.description" name="description"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm form-input w-full"></textarea>
            </div>

            <div class="grid grid-cols-2">
                <div class="mb-4">
                    <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">Fecha de inicio</label>
                    <input type="date" id="start_date" v-model="form.start_date" name="start_date"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm form-input" />
                </div>

                <div class="mb-4">
                    <label for="end_date" class="block text-gray-700 text-sm font-bold mb-2">Fecha final</label>
                    <input type="date" id="end_date" v-model="form.end_date" name="end_date"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm form-input" />
                </div>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Imagen</label>
                <input type="file" id="image" @change="handleFileUpload" name="image"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm form-input" />


            </div>

            <div class="mb-4">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Enviar</button>
            </div>
        </form>
    </section>
</template>

<style scoped></style>
