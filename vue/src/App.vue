<!-- :style and :class -->
<template>
  <div>
    <div class="h-screen flex items-center justify-center">
      <div v-if="state === 'error'">
        Une erreur s'est survenue lors du chargment du fichier
      </div>
      <Quiz :aria-busy="state === 'loading'" :quizs="quizs" v-if="quizs"/>

    </div>
    <p>TODO LIST</p>
    <form @submit.prevent="addTodo">
      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 content-center">
        <div class="sm:col-span-3">
          <div class="mt-2">
            <input type="text"
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
              v-model="todoTitle" />
          </div>
        </div>
        <button type="submit" :disabled="todoTitle.length == 0" class="bg-green-500 text-white rounded">Ajouter un
          todo</button>
      </div>
    </form>
    <hr class="h-5 my-2" />
    <div class="pl-5">
      <div v-if="todoLists.length <= 0">
        <p>Vous n'avez pas encore de todo</p>
      </div>
      <ul v-else>
        <div v-if="sortedTodos.length == 0 && todoCompleted == true">
          <p>Vous n'avez pas encore éffectué de todo </p>
        </div>
        <li :key="todoList.date" v-for="todoList in sortedTodos" v-else>
          <Checkbox :title="todoList.title" @checked="(p) => console.log('checked', p)" @unckecked="(p) => console.log('unckecked', p)" v-model:check="todoList.completed" :class="[todoList.completed ? 'opacity-50' : '', todoList.completed ? 'line-through' : '']"/>
          <!-- <div class="flex gap-3" :class="{ 'opacity-50': todoList.completed }">
            <div class="flex h-6 shrink-0 items-center">
              <div class="group grid size-4 grid-cols-1">
                <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox"
                  v-model="todoList.completed"
                  class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto">
                <svg
                  class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25"
                  viewBox="0 0 14 14" fill="none">
                  <path class="opacity-0 group-has-[:checked]:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" />
                  <path class="opacity-0 group-has-[:indeterminate]:opacity-100" d="M3 7H11" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
            </div>
            <div class="text-sm/6">
              <label for="comments" class="font-medium text-gray-900">Comments</label> 
              <p id="comments-description" class="text-gray-500" :class="{ 'line-through': todoList.completed }">{{
                todoList.title }}</p>
            </div>
          </div> -->
        </li>
      </ul>
    </div>
    <div class="flex gap-3 my-3" v-if="todoLists.length > 0">
      <div class="flex h-6 shrink-0 items-center">
        <div class="group grid size-4 grid-cols-1">
          <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox"
            v-model="todoCompleted"
            class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto">
          <svg
            class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25"
            viewBox="0 0 14 14" fill="none">
            <path class="opacity-0 group-has-[:checked]:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round" />
            <path class="opacity-0 group-has-[:indeterminate]:opacity-100" d="M3 7H11" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
      </div>
      <div class="text-sm/6">
        <!-- <label for="comments" class="font-medium text-gray-900">Comments</label> -->
        <p class="text-gray-500">Les Tâches éffectuées</p>
      </div>
    </div>
    <hr class="h-5 my-10" />
    <p>first name {{ firstName }}</p>
    <p :id="`p-${count}`">tu as clické {{ count }} fois</p>
    <p v-if="count > countmaxtowin">vous avez dépassé les {{ countmaxtowin }} click</p>
    <p class="" v-else>Vous y êtes presque.</p>
    <button @click="increment">increment</button>

    <form action="" method="" @submit.prevent="addMovie">
      <input type="text" placeholder="Entrer le nom du film" v-model="movieName" />
      <button>Ajouter</button>
    </form>
    <ul>
      <li :key="key" v-for="(movie, key) in movies">
        {{ movie }}&nbsp; <button @click="deleteMovie(movie)">Supprimer</button>
      </li>
    </ul>

    <ul>
      <li>{{ person.firstName }}</li>
      <li>{{ person.lastName }}</li>
      <li>{{ person.age }}</li>
      <button @click.prevent="randomAge">age aléatoire</button>
    </ul>
  </div>
</template>

<script setup>
import { computed, ref, onMounted } from "vue";
import Checkbox from './Component/Checkbox.vue';
let todoTitle = ref('');
let todoCompleted = ref(false);
let todoLists = ref([

]);

import Quiz from "./Component/Quiz.vue";
let quizs = ref({});
let state = ref('loading');


const addTodo = () => {
  todoLists.value.push({
    title: todoTitle.value,
    completed: false,
    date: Date.now()
  });
  todoTitle.value = '';
};

onMounted(() => {
  fetch('https://jsonplaceholder.typicode.com/todos')
      .then(response => response.json())
      .then(json => todoLists.value = json.map(todo => ({...todo, date: todo.id})) );

      fetch('./quiz.json').then(r => {
        console.log('r', r);
        if(r.ok){
          return r.json();
        }
        throw new Error('Impossible de charger le fichier');
      }).then(data => {
        console.log('data', data);
        quizs.value = data;
        state.value = 'ok';
      }).catch(e => {
        state.value = 'error';
      })
});

const sortedTodos = computed(() => {
  const sortedTodos = todoLists.value.sort((a, b) => a.completed > b.completed ? 1 : -1);
  if (todoCompleted.value == true) {
    return sortedTodos.filter(t => t.completed == true);
  }
  return sortedTodos;
});
//---------------------
let movieName = ref("");
const count = ref(0);
const countmaxtowin = ref(10);
const movies = ref([
  "Matrix",
  "Batman",
  "SpiderMan"
]);

const person = ref({
  'firstName': 'Matthew',
  "lastName": "SEGBE",
  "age": 24
})

const deleteMovie = (movie) => {
  movies.value = movies.value.filter(m => m !== movie);
}
let firstName = ref("Mendo");

const increment = () => {
  count.value++
};

const randomAge = () => {
  person.value = {
    ...person.value,
    //ajouter les anciens données
    "age": Math.round(Math.random() * 1000)
  }
}

const addMovie = (event) => {
  //event.preventDefault();
  movies.value.push(movieName.value);
  movieName.value = '';
}
</script>
