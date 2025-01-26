<template>
    <div v-if="questions">
            {{ questions.question }}
            <div>
                <div class="flex flex-col gap-10 mt-2">
                    <div v-bind:key="q"
                        v-for="(q, index) in currentQuestion">
                        <InputCheckBox :index="index" :value="q" v-model="model" :current-answer="questions.correct_answer" />
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" @click="nextquestion" :disabled="model == ''"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </div>
        </div>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import { surffleArray } from "../ramdomarray";
import InputCheckBox from "./InputCheckBox.vue"

const props = defineProps({
    questions : Object
});

const model = defineModel();

const emits = defineEmits(['nextquestion'])

//const answer = ref('');

function nextquestion() {
    //const a = answer.value;
    emits('nextquestion', model.value);
    //answer.value = '';
}

let currentChoices = ref([]);

watch(() => props.questions.choices, (newValue) => {
    console.log("newValue", newValue);
    currentChoices.value = newValue;
});

let currentQuestion = computed(() => {
    return surffleArray(currentChoices.value);
})
</script>