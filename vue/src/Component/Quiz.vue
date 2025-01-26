<template>
    <div v-if="quizs">
        <p>{{ quizs.title }}</p>
        <ProgressBar :questions="quizs.questions" :index="index" class="w-80" />
        <Question :key="questions.question" :questions="questions" :choices="questions.choices" v-if="questions && !showanswers"
            @nextquestion="(answer) => getQuestionAnswer(answer)" v-model="answermodel" />
        <div v-if="showanswers">
            <p>Vous avez trouver {{ lenghtOfCorrectAnswer.length }} réponse sur {{ quizs.questions.length }}</p>
            <ul class="list-none" :key="index" v-for="(resume, index) in answers">
                <li>{{ `${index + 1} - ${resume.title}` }}
                    <ul>
                        <li class="flex items-center">
                            <svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 flex-shrink-0"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>
                            La bonne réponse : {{ resume.correct_answer }}
                        </li>
                        
                        <li class="flex items-center">
                            <svg v-if="resume.is_correct" class="w-3.5 h-3.5 me-2 flex-shrink-0 text-green-500 dark:text-green-400"
                                aria-hidden="false" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>
                            <svg v-else class="w-3.5 h-3.5 me-2 flex-shrink-0 text-red-500 dark:text-red-400" fill="currentColor"  version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 208.891 208.891" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M0,170l65.555-65.555L0,38.891L38.891,0l65.555,65.555L170,0l38.891,38.891l-65.555,65.555L208.891,170L170,208.891 l-65.555-65.555l-65.555,65.555L0,170z"></path> </g></svg>
                            Votre réponse : {{ resume.user_answer }}
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import ProgressBar from './ProgressBar.vue';
import Question from './Question.vue';
import { computed, ref, onMounted } from "vue";
let props = defineProps({
    quizs: Object
});

let answers = ref([]);
let index = ref(0);
let showanswers = ref(false);
const answermodel = ref('');

const questions = computed(() => {
    return props.quizs.questions ? props.quizs.questions[index.value] : {};
});

// onMounted(() => {
//     index.value = 0;
// });

const lenghtOfCorrectAnswer = computed(() => {
    return answers.value.filter(c => c.is_correct == true);
});
function getQuestionAnswer(answer) {
    console.log('questions.value', questions.value);
    if (!questions.value) {
        return;
    }
    let answerObjet = {
        "title": questions.value.question,
        "correct_answer": questions.value.correct_answer,
        "user_answer": answer,
        "is_correct": questions.value.correct_answer === answer
    };
    answers.value[index.value] = answerObjet;
    index.value++;
    if (index.value > props.quizs.questions.length - 1) {
        showanswers.value = true;
    }
    answermodel.value = '';
}


</script>