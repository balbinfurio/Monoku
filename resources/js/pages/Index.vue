<template>
    <h1>Your prompt:</h1>

    <form @submit.prevent="$event => form.post('/ai')">
        <input type="text" v-model="form.prompt" />
        <button type="submit">Send request</button>
    </form>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3'

    let form = useForm({
        prompt: ''
    })
</script>