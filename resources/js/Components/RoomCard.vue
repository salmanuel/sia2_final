<template>
    <div :class="{'rounded-lg p-4 border-2 border-green-600 bg-gray-900 shadow flex hover:bg-gray-600 text-white': room.available, 'rounded-lg p-4 border-2 border-gray-400 bg-gray-200 shadow flex hover:bg-gray-300': !room.available}">
      <div class="cursor-pointer flex flex-1">
        <div class="w-[160px] h-[150px] flex justify-center items-center text-center">
          <img :src="room.picUrl" alt="Room Image" class="aspect-square w-full object-cover mb-4 mt-4 rounded">
        </div>
        <div class="ml-4 flex-1" @click="open(room)">
          <h3 class="font-bold">Room Details</h3>
          <hr>
          <div class="text-2xl">{{ room.bed_type }}</div>
          <div class="italic">Php {{ room.rate }}</div>
          <div class="italic">{{ room.rooms_available }} rooms available</div>
        </div>
        <!-- <div class="flex justify-between"> -->
        <div v-if="$page.props.auth.user.roles.includes('admin')" class="flex justify-between">
          <div>&nbsp;</div>
          <label :for="'status-' + room.id" class="switch">
            <input type="checkbox" :id="'status-' + room.id" :checked="room.available" @change="toggleActive(room)">
            <span class="slider round"></span>
          </label>
        </div>
      </div>
    </div>
</template>
  

<script setup>
    import { router } from '@inertiajs/vue3';
    import { computed } from 'vue'


    const props = defineProps({
        room: Object,
    })

    function open(room) {
        router.visit('/rooms/' + room.id)
    }

    function toggleActive(room) {
        router.visit('/rooms/toggle/' + room.id, {
            method: 'post',
            preserveScroll: true
        })
    }

    // const user = computed(() => page.props.auth.user)
</script>

<style scoped>
    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #f321f0;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #f321f0;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(16px);
        -ms-transform: translateX(16px);
        transform: translateX(16px);
    }

    .slider.round {
        border-radius: 20px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
