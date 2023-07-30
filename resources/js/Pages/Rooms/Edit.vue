<template>
    <AppLayout title="Edit Room Details">
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-200 leading-tight">Edit Room Details</h2>
                <Link class="bg-gray-500 hover:bg-blue-400 text-white font-semibold hover:text-white py-2 px-4 border border-gray-700 hover:border-transparent rounded mb-2" as="button" :href="'/rooms/' + room.id">Back</Link>
            </div>
        </template>

        <div class="py-6">
            <div class="bg-white max-w-4xl p-4 mx-auto rounded-lg border">
                <form @submit.prevent="submit" class="flex">
                    
                    <div class="flex-1 pr-4">
                        <h4 class="text-xl mb-4">Room Details</h4>
                        <div class="form-field">
                            <label for="bed_type" class="block font-semibold text-gray-700 mb-1">Bed Type </label>
                            <select id="bed_type" v-model="form.bed_type" class="w-full px-4 py-2 border rounded-lg bg-white text-gray-700 focus:outline-none focus:border-blue-500 shadow">
                              <option value="Single">Single</option>
                              <option value="Double">Double</option>
                              <option value="King">King</option>
                            </select>
                          </div>

                          <div class="form-field">
                            <label for="rate" class="block font-semibold text-gray-700 mb-1">Rate </label>
                            <input type="decimal" id="rate" v-model="form.rate" class="w-full px-4 py-2 border rounded-lg bg-white text-gray-700 focus:outline-none focus:border-blue-500 shadow">
                          </div>
              
                          <div class="form-field">
                            <label for="rooms_available" class="block font-semibold text-gray-700 mb-1"> Rooms Available </label>
                            <input type="number" id="rooms_available" v-model="form.rooms_available" class="w-full px-4 py-2 border rounded-lg bg-white text-gray-700 focus:outline-none focus:border-blue-500 shadow" >
                          </div>
                            <div class="flex justify-center">
                                <button class="button mt-2 bg-blue-500 p-2 rounded text-white" type="submit">Save Changes</button>
                            </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';

    const props = defineProps({
        room: Object
    })

    const form = useForm({
        bed_type: props.room.bed_type,
        rate: props.room.rate,
        rooms_available: props.room.rooms_available,
    })

    function submit() {
        form.patch('/rooms/' + props.room.id)
    }
</script>
