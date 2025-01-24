<template>
    <div class="card" v-if="questions">
        <p>Question {{index < questions.length ? index + 1 : index}} / {{ questions.length }}</p>
        <ProgressBar :value="value" class="h-10"> {{ value }} %</ProgressBar>
        <!-- <progress></progress> -->
    </div>
</template>

<script setup>
import { computed, ref } from 'vue';

let props = defineProps({
    questions : Array,
    index : {
        type : Number,
        default : 1
    },
})

let value = computed(() => {
    return props.index * 100 / props.questions.length
})
</script>