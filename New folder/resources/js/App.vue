<template>
    <div class="app">
        kjshdjkhsdjkhsjkdhkjshdjkshjdh
        <draggable v-model="myArray" group="people" @start="drag=true" @end="drag=false">
            <div v-for="element in myArray" :key="element.id">nrnrgnn</div>
         </draggable>
    </div>
</template>
<script>
    import draggable from 'vuedraggable'
    export default {
        name:'app',
        components: {
            draggable,
        },
    }
</script>
