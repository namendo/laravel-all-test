<template>
    <div v-if="questions">
            {{ questions.question }}
            <div>
                <div class="flex flex-col gap-10 mt-2">
                    <div class="inline-flex items-center" v-bind:key="q"
                        v-for="(q, index) in currentQuestion">
                        <label class="relative flex items-center cursor-pointer" :for="`answer${index}`">
                            <input name="framework" type="radio"
                                class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all"
                                :id="`answer${index}`" v-model="answer" :value="q"/>
                            <span
                                class="absolute bg-slate-800 w-3 h-3 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
                        </label>
                        <label class="ml-2 text-slate-600 cursor-pointer text-sm" :for="`answer${index}`">
                            <p>
                                {{ q }}
                            </p>
                        </label>
                    </div>
                </div>

            </div>
            <div class="mt-2">
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" @click="nextquestion" :disabled="answer == ''"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </div>
        </div>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import { surffleArray } from "../ramdomarray"

const props = defineProps({
    questions : Object
});

const emits = defineEmits(['nextquestion'])

const answer = ref('');

function nextquestion() {
    const a = answer.value;
    emits('nextquestion', a);
    answer.value = '';
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