<template>
    <div>i am Child {{name}}</div>
    <button v-on:click="method">dfdsf</button>
</template>

<script>
export default({
    name : 'child',
    props : {
        name : String,
        method: Function
    },
    setup() {
    //    this.getData() 
    },
})
</script>


