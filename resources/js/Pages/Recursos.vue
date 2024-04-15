<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { computed,ref,defineProps  } from 'vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

import RecursosTexto from '../Components/RecursosTexto.vue'
const props = defineProps({
    recursosRelacionados:Object,
    id_curso:Object
});

let titulo=ref('')
let contenido=ref('')
let visible=ref('')

let titulo2=ref('')
let contenido2=ref('')
let visible2=ref('')
let recursosRelacionados=ref(props.recursosRelacionados);


function createrecurso(){
    axios.post('/createrecurso', {
        titulo: titulo.value,
        contenido: contenido.value,
        visible: visible.value,
        id_curso:props.id_curso
        }).then(response => {
            // Handle success
            
            console.log( response);
            getALlRecursos()
        }).catch(error => {
            // Handle error
            console.error('An error occurred:', error);
        });
}
function getALlRecursos(){
    axios.post('/getALlRecursos', {
        id_curso:props.id_curso

        }).then(response => {
            // Handle success
            recursosRelacionados.value=response.data.message;
        }).catch(error => {
            // Handle error
            console.error('An error occurred:', error);
        });
}

function editRecurso(){
console.log(titulo2.value)
    axios.post('/editRecurso', {
        idRecurso_:idRecurso_,
        titulo:titulo2.value,
        contenido:contenido2.value,
        visible:visible2.value,
        }).then(response => {
            // Handle success
            getALlRecursos()
            console.log("--- aquiii editadooo")
            console.log(response)
        }).catch(error => {
            // Handle error
            console.error('An error occurred:', error);
        });
}
let idRecurso_;
function loadRecruso(id){
    idRecurso_=id;
    axios.post('/loadRecruso', {
        idRecurso:id,
      
        }).then(response => {
            titulo2.value=response.data.message.titulo
             contenido2.value=response.data.message.contenido
             visible2.value=response.data.message.visible
  
            console.log(response)
        }).catch(error => {
            // Handle error
            console.error('An error occurred:', error);
        });
}

function deleteRecurso(id){
    axios.post('/deleteRecurso', {
        idRecurso_:id,
      
        }).then(response => {
                       getALlRecursos()

            console.log(response)
        }).catch(error => {
            // Handle error
            console.error('An error occurred:', error);
        });
}
const isChecked = computed({
  get: () => visible2.value == 1, // Cuando visible2 es 1, isChecked será true
  set: (newValue) => {
    visible2.value = newValue ? 1 : 0; // Cuando el checkbox cambia, asigna 1 o 0 a visible2
  }
});

const editorData = ref('');
const editor = ClassicEditor;
const editorConfig = {
  extraPlugins: [customPlugin],

  // Aquí podemos insertar estilos adicionales para el contenido del editor
  ckfinder: {
    // Opciones para el plugin CKFinder si es necesario
  },
  // Otras configuraciones del editor
};

// Plugin para inyectar estilos adicionales
function customPlugin(editor) {
  editor.model.document.on('change:data', () => {
    editor.editing.view.change(writer => {
      writer.setStyle(
        'padding-left',
        '20px', // Ajusta el padding según sea necesario
        editor.editing.view.document.getRoot()
      );
      writer.setStyle(
        'color',
        'black', // Ajusta el padding según sea necesario
        editor.editing.view.document.getRoot()
      );
    });
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
                    <button  onclick="my_modal_1.showModal()" class="btn btn-success color-white">Crear Recurso</button>
                    
                    <dialog id="my_modal_1" class="modal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">Hello!</h3>
                        
                        <div class="modal-action">
                        <form method="dialog" style="display:block;">
                            

                            <input type="text" placeholder="Nombre del curso" class="input input-bordered w-full max-w-xs" v-model="titulo"/>
                            <ckeditor :editor="editor" v-model="contenido" :config="editorConfig"></ckeditor>

                            <div>
                                <label>Visible<input type="checkbox" checked="checked" class="checkbox" v-model="visible"/></label>
                            </div>
                            <div style="display:flex;"> 
                                <button @click="createrecurso" class="btn btn-success" >Crear</button>
                                <button class="btn" style="display:block;">Close</button>
                            </div>
                            
                        </form>
                        </div>
                    </div>
                    </dialog>
            </div>
        </div>
       <div>
                <div v-for="(item,index) in recursosRelacionados">
                    <div>
                        <RecursosTexto :item="item.titulo" />
                        
                        <button class="btn btn-success" onclick="my_modal_2.showModal()" @click="loadRecruso(item.id)">Editar</button>
                        

                        <button class="btn btn-warning" @click="deleteRecurso(item.id)">Eliminar</button>

                    </div>
                </div>
       </div>

                    
                    <dialog id="my_modal_2" class="modal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">Editar!</h3>
                        
                        <div class="modal-action">
                        <form method="dialog" style="display:block;">
                            

                            <input type="text" placeholder="Nombre del curso" class="input input-bordered w-full max-w-xs" v-model="titulo2"/>
                            <ckeditor :editor="editor" v-model="contenido2" :config="editorConfig"></ckeditor>
                            <div>
                                <label>Visible<input type="checkbox"  class="checkbox" v-model="isChecked"/></label>
                            </div>
                            <div style="display:flex;"> 
                                <button @click="editRecurso" class="btn btn-success" >Editar</button>
                                <button class="btn" style="display:block;">Close</button>
                            </div>
                            
                        </form>
                        </div>
                    </div>
                    </dialog>
    </AuthenticatedLayout>

</template>
<style>
.modal-box{
    width: auto;
}
</style>
