<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

const props = defineProps({
    recurso:Object
});
let recurso=ref(props.recurso);

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

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
let cookieshow=ref(true)
function cookies(){
    
    cookieshow.value=false;
}
</script>

<template>
  <div class="navbar bg-base-100">
  <div class="flex-1">
    <a href="/"> Home</a>
  </div>
  <div class="flex-none">
    <ul class="menu menu-horizontal px-1">
      <li><a>Link</a></li>
   
     
    </ul>
  </div>
</div>


<div style="    display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: center;
    align-items: center;">
                
                <div >
                    <div class="mt-5">
                        <h1>Titulo {{ recurso.titulo }}</h1>
                        <p>Contenido: </p>
                        <div v-html="recurso.contenido"></div>
                    </div>
                </div>
        </div>


</template>
