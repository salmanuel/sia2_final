<template>
    <AppLayout title="Show Room">
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-200 leading-tight">Room Details</h2>
                <Link class="bg-gray-500 hover:bg-blue-400 text-white font-semibold hover:text-white py-2 px-4 border border-gray-700 hover:border-transparent rounded mb-2" as="button" :href="'/rooms/'">Back</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-300 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex">
                        <div class="w-[200px] h-[200px] flex justify-center items-center">
                            <img :src="room.picUrl" alt="Room Image" class="aspect-square w-full object-cover mb-4">
                        </div>
                        <div class="flex-1 ml-4">
                            <div class="flex">
                                <h3 class="text-2xl flex-1">{{ room.bed_type }}</h3>
                                <div v-if="props.auth.user.roles.includes('admin')">
                                    <Link class="button mr-2 bg-red-500 p-2 hover:bg-red-700 rounded text-white" :href="'/rooms/' + room.id" method="delete" as="button">Delete</Link>
                                    <Link class="button mb-2 bg-green-600 p-2 hover:bg-green-800 rounded text-white" :href="'/rooms/edit/' + room.id" as="button">Edit</Link>
                                </div>
                            </div>
                            <hr>
                            <div class="mt-4">Php {{ room.rate }}</div>
                            <div class="py-4">{{ room.rooms_available }} rooms available</div>
                            
                            <div class="mt-4" v-if="room.available">
                                Available: <bold class="text-green-500" style="text-decoration: underline;"> Yes </bold>
                            </div>
                            <div class="mt-4" v-else>
                                Available: <bold class="text-red-500" style="text-decoration: line-through;"> No </bold>
                            </div>
                        </div>
                    </div>
                    <div v-if="props.auth.user.roles.includes('customer') && room.available" class="flex justify-end pr-6 pb-6">
                        <Link class="bg-green-700 hover:bg-green-600 text-gray-200 font-semibold py-2 px-4 rounded">
                            &#x1F6D2;Book Now
                        </Link>
                    </div>
                    <div v-if="props.auth.user.roles.includes('admin')" class="p-6 text-gray-900">
                        <h3 class="text-xl font-semibold mb-4">Bookings for this Room</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead class="bg-gray-500 text-white">
                                    <tr>
                                        <th class="px-4 py-2">Last Name</th>
                                        <th class="px-4 py-2">First Name</th>
                                        <th class="px-4 py-2">Arrival Date</th>
                                        <th class="px-4 py-2">Departure Date</th>
                                        <th class="px-4 py-2">Num Adults</th>
                                        <th class="px-4 py-2">Num Kids</th>
                                        <th class="px-4 py-2">Phone</th>
                                        <th class="px-4 py-2">Email</th>
                                        <th>...</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Loop through bookings data and generate rows -->
                                    <tr v-for="bkng in room.bookings" :key="bkng.id">
                                        <td class="border border-green-900 px-4 py-2">{{ bkng.last_name }}</td>
                                        <td class="border border-green-900 px-4 py-2">{{ bkng.first_name }}</td>
                                        <td class="border border-green-900 px-4 py-2">{{ bkng.arrival_date }}</td>
                                        <td class="border border-green-900 px-4 py-2">{{ bkng.departure_date }}</td>
                                        <td class="border border-green-900 px-4 py-2">{{ bkng.num_adults }}</td>
                                        <td class="border border-green-900 px-4 py-2">{{ bkng.num_kids }}</td>
                                        <td class="border border-green-900 px-4 py-2">{{ bkng.phone }}</td>
                                        <td class="border border-green-900 px-4 py-2">{{ bkng.email }}</td>
                                        <Link :href="'/rooms/email/' + room.id" class="border border-green-900 p-2 rounded shadow flex">Send Email</Link>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Head, Link, usePage } from '@inertiajs/vue3';
    import { computed } from 'vue'

    const props = defineProps({
        room: Object,
        auth: Object
    })

    const page = usePage()

    const user = computed(() => page.props.auth.user)
</script>
