<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin</h2>
        </template>

        <div class="py-12">
            <div class="flex justify-center items-center">
                <div class="p-4 rounded-lg bg-gray-300 shadow-sm w-1/4">
                    <h1 class="text-2xl text-center mb-10">Send email to all clients</h1>
                    <form @submit.prevent="submit">
                        <div class="flex items-start space-x-2 mb-4">
                            <label for="subject">Subject&nbsp;&nbsp;</label>
                            <input v-model="form.subject" type="text" id="subject" class="px-2 py-1 w-full rounded-md">
                        </div>
                        <div class="flex items-start space-x-2 mb-4">
                            <label for="message">Message</label>
                            <textarea v-model="form.message" type="text" id="message" class="px-2 py-1 h-[120px] w-full rounded-md"></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="text-white px-4 py-1.5 text-center rounded-md bg-blue-600">Send mail</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Head, useForm } from '@inertiajs/vue3';

    const form = useForm({
        subject: '',
        message: ''
    })

    const submit = () => {
        form.post('/admin/email')

        form.subject = ''
        form.message = ''
    }

    const props = defineProps({
        message: Object
    })
</script>
