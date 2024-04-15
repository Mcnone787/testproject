<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { ref,defineProps  } from 'vue';

const props = defineProps({
    cursos:Object
});

let nombre=ref('')
let etapa=ref('')
let descripcion=ref('')
let visible=ref('')
let cursos=ref(props.cursos);


function createcurso(){
    axios.post('/createcurso', {
        nombre: nombre.value,
        etapa: etapa.value,
        descripcion: descripcion.value,
        visible: visible.value,
        }).then(response => {
            // Handle success
            getALlCursos(); 
        }).catch(error => {
            // Handle error
            console.error('An error occurred:', error);
        });
}
function getALlCursos(){
    axios.post('/getALlCursos', {
        
        }).then(response => {
            // Handle success
            cursos.value=response.data.message;
            console.log(cursos.value)
        }).catch(error => {
            // Handle error
            console.error('An error occurred:', error);
        });
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
            
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <button  onclick="my_modal_1.showModal()" class="btn btn-success color-white">Crear curso</button>
                    
                    <dialog id="my_modal_1" class="modal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">Hello!</h3>
                        
                        <div class="modal-action">
                        <form method="dialog" style="display:block;">
                            <input type="text" placeholder="Nombre del curso" class="input input-bordered w-full max-w-xs" v-model="nombre"/>
                            <input type="text" placeholder="Etapa del curso" class="input input-bordered w-full max-w-xs" v-model="etapa" />
                            <input type="text" placeholder="Descripcion" class="input input-bordered w-full max-w-xs" v-model="descripcion"/>
                            <div>
                                <label>Visible<input type="checkbox" checked="checked" class="checkbox" v-model="visible"/></label>

                            </div>
                            <div style="display:flex;"> 
                                <button @click="createcurso" class="btn btn-success" >Crear</button>
                                <button class="btn" style="display:block;">Close</button>
                            </div>
                            
                        </form>
                        </div>
                    </div>
                    </dialog>
            </div>
        </div>
        <div style="    display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: center;
    align-items: center;">
                
                <div v-for="(item,index) in cursos">
                    <div class="mt-5">
                        <a :href="`recurso/${item.id}`">{{ item.nombre }}</a>
                    </div>
                </div>
        </div>
    </AuthenticatedLayout>
</template>
