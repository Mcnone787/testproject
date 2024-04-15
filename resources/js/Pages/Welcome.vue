<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
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
    <img src="img/logo.png" style="width:auto;height:70px;">
  </div>
  <div class="flex-none">
    <ul class="menu menu-horizontal px-1">
      <li><a>Link</a></li>
      <li><a href="login">Login</a></li>
      <li><a href="register">Register</a></li>
      <li></li>
     
    </ul>
  </div>
</div>

<div class="Banner">

    <img src="img/banner.jpg" class="w-full" style="height:480px; object-fit: cover;">
</div>
<div>
        <p class="text-center mt-5">En esta web podras ver mucha informacion de diferentes cursos que tenemos para ti!</p>
</div>
<div style="background-color:gray;position:absolute;height: 100px;display:flex;justify-content: center;
    flex-direction: row;" class="w-full" v-show="cookieshow" >
    <div>
        <p style="color:white;">Acepta nuestra politica de cookies?</p>
    </div>
    <button @click="cookies"  class="btn btn-success">Aceptar</button>

</div>
</template>
