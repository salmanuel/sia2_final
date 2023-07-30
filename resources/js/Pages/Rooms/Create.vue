<template>
    <AppLayout title="Add Room">
      <template #header>
        <div class="flex">
          <h2 class="flex-1 font-semibold text-xl leading-tight">Add Room</h2>
          <Link
            class="bg-blue-500 hover:bg-blue-400 text-white font-semibold hover:text-white py-2 px-4 border border-gray-700 hover:border-transparent rounded mb-2" as="button" href="/rooms" >Back
          </Link>
        </div>
      </template>
  
      <div class="py-6">
        <div class="bg-white max-w-4xl p-4 mx-auto rounded-lg border shadow-lg">
          <form @submit.prevent="submit" class="flex">
            <div class="flex-1 pr-4">
              <h4 class="text-xl mb-4">Personal Details</h4>
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
                <input type="decimal" id="rate" v-model="form.rate" class="w-full px-4 py-2 border rounded-lg bg-white text-gray-700 focus:outline-none focus:border-blue-500 shadow" >
              </div>
  
              <div class="form-field">
                <label for="rooms_available" class="block font-semibold text-gray-700 mb-1"> Rooms Available </label>
                <input type="number" id="rooms_available" v-model="form.rooms_available" class="w-full px-4 py-2 border rounded-lg bg-white text-gray-700 focus:outline-none focus:border-blue-500 shadow" >
              </div>
  
              <div class="form-field">
                <label for="photo" class="block font-semibold text-gray-700 mb-1"> Room Image </label>
                <input type="file" @input="form.photo = $event.target.files[0]" class="w-full px-4 py-2 border rounded-lg bg-white text-gray-700 focus:outline-none focus:border-blue-500 shadow" accept="image/jpeg"/>
                <progress v-if="form.progress" :value="form.progress.percentage" max="100"> {{ form.progress.percentage }}% </progress>
              </div>
              <div class="flex justify-center mt-4">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline shadow" type="submit"> Add Room </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </AppLayout>
  </template>
  
  


<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Link, useForm } from '@inertiajs/vue3';

    const form = useForm({
        bed_type: null,
        photo: null,
        rate: null,
        rooms_available: null
    })

    function submit() {
        form.post('/rooms/')
    }
</script>
