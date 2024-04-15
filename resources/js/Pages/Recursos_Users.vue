<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import RecursosTexto from '../Components/RecursosTexto.vue'

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

const props = defineProps({
  id_curso:Object,
  recursosRelacionados:Object
});
let id_curso=ref(props.id_curso);
let recursosRelacionados=ref(props.recursosRelacionados)
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
<h1>Recursos</h1>
<div v-for="(item,index) in recursosRelacionados">
                    <div>
                      <div class="">
                       <a :href="'/infoRecurso/'+item.id"><p class="text-center"> Nombre del recurso: 
                        {{ item.titulo }}</p></a>

                      </div>
                    </div>
                </div>
</template>
