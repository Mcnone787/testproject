
<script setup>
    import { ref,defineProps  } from 'vue';
    let props=defineProps({
        item:Object
    })
</script>
<template>
    <p>{{ props.item }}</p>
</template>