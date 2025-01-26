<template>
    <div class="inline-flex items-center">
        <label class="relative flex items-center cursor-pointer" :for="`answer${index}`" >
            <input name="framework" type="radio" :disabled="isDisable"
                class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all"
                :id="`answer${index}`" v-model="model" :value="value" />
            <span
                class="absolute bg-slate-800 w-3 h-3 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></span>
        </label>
        <label :class="classes" class="ml-2 text-slate-600 cursor-pointer text-sm" :for="`answer${index}`">
            <p>
                {{ value }}
            </p>
        </label>
    </div>
</template>

<script setup>
import { computed, onMounted } from 'vue';
const props = defineProps({
    index: Number,
    currentAnswer: String,
    value: String
})

const model = defineModel()

const isDisable = computed(() => model.value !== '')

const classes = computed(() => ({
    right : isDisable.value && props.value === props.currentAnswer,
    wrong : isDisable.value && props.value !== props.currentAnswer && model.value === props.value,
    neutral : isDisable.value && model.value !== props.value && props.value !== props.currentAnswer
}))
</script>

<style>

.right{
    color: green !important;
}

.wrong{
    color: red !important;
}

.neutral{
    opacity: 0.5;
}
</style>