<script setup>
import { ref, computed, reactive } from 'vue'

let id = 0

const newTodo = ref('')
const hideCompleted = ref(false)
const todos = reactive([
  { id: id++, text: 'Learn HTML', done: true },
  { id: id++, text: 'Learn JavaScript', done: true },
  { id: id++, text: 'Learn Vue', done: false }
]);

const filteredTodos = computed(() => {
	if(hideCompleted.value){
   return todos.filter(todo => !todo.done)
  }else{
    return todos;
  }
})

function addTodo() {
  todos.push({ id: id++, text: newTodo.value, done: false })
  newTodo.value = ''
}
 
function removeTodo(todo, index) {
	todos.splice(todos.indexOf(todo),1);
}
</script>

<template>
  <form @submit.prevent="addTodo">
    <input v-model="newTodo" />
    <button>Add Todo</button>
  </form>
  <ul>
    <li v-for="todo in filteredTodos" :key="todo.id">
      <input type="checkbox" v-model="todo.done">
      <span :class="{ done: todo.done }">{{ todo.text }}</span>
      <button @click="removeTodo(todo)">X</button>
    </li>
  </ul>
  <button @click="hideCompleted = !hideCompleted">
    {{ hideCompleted ? 'Show all' : 'Hide completed' }}
  </button>
</template>

<style>
.done {
  text-decoration: line-through;
}
</style>