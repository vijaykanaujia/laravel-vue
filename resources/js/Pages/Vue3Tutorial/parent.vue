<template>
    <div>i am parent</div>
    <child :name="name" :method="getData"></child>
</template>

<script>
import ChildComponent from '@/Pages/Vue3Tutorial/child.vue';
export default({
    data(){
        return {
            name : 'Vijay'
        }
    },
    setup() {
        
    },
    components : {
        'child' : ChildComponent
    },
    methods : {
        getData(){
            debugger;
        }
    }
})
</script>
