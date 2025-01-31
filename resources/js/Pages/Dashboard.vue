<script setup lang="ts">
import Hero from '@/Components/Dashboard/Hero.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
const props = defineProps(['jobs']);

console.log(props.jobs);

const formatTimeAgo = (timestamp) => {
  const now = new Date();
  const createdAt = new Date(timestamp);
  const diffInSeconds = Math.floor((now - createdAt) / 1000);

  if (diffInSeconds < 60) {
    return `${diffInSeconds} seconds ago`;
  } else if (diffInSeconds < 3600) {
    return `${Math.floor(diffInSeconds / 60)} minutes ago`;
  } else if (diffInSeconds < 86400) {
    return `${Math.floor(diffInSeconds / 3600)} hours ago`;
  } else {
    return `${Math.floor(diffInSeconds / 86400)} days ago`;
  }
};

</script>



<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- Hero -->
        <Hero />

        <!-- Job List -->
        <div class="bg-white">
            <div class="container py-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white border shadow-sm rounded-2xl p-6" v-for="job in props.jobs" :key="job.id">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <img
                                    v-if="job.logo"
                                    :src="`/storage/${job.logo}`"
                                    class="h-12 w-auto block mx-auto"
                                    alt="Job Logo"
                                />
                                <img
                                    v-else
                                    src="/storage/company_logos/default.svg"
                                    class="h-12 w-auto block mx-auto"
                                    alt="Default Job Logo"
                                />
                            </div>
                            <div class="ml-4">
                                <h2 class="text-xl font-semibold">{{ job.title }}</h2>
                                <p class="text-sm text-gray-500">{{ job.company_name }}</p>
                            </div>
                        </div>
                        <div class="flex text-gray-700 text-sm mb-4 space-x-4">
                            <p class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 3h-1V2a1 1 0 10-2 0v1H8V2a1 1 0 10-2 0v1H5a3 3 0 00-3 3v13a3 3 0 003 3h14a3 3 0 003-3V6a3 3 0 00-3-3zm1 16a1 1 0 01-1 1H5a1 1 0 01-1-1V10h16zm0-11H4V6a1 1 0 011-1h1v1a1 1 0 102 0V5h8v1a1 1 0 102 0V5h1a1 1 0 011 1z"/>
                                </svg>
                                <span class="text-sm text-gray-500">{{ job.experience }}</span>
                            </p>
                            <p class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24" aria-label="Pound Sterling Symbol">
                                <path d="M12 1v7.5h-1.5V2.5H9v6h-1.5V1H5v20h7v-6h-1.5v-3h2.5v3H12v6h7V1h-7z"/>
                                </svg>
                                <span class="text-sm text-gray-500">{{ job.salary }}</span>
                            </p>
                            <p class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm text-gray-500">{{ job.extra_info }}</span>
                            </p>
                        </div>
                        <p class="flex items-center gap-2 text-sm mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24" aria-label="Job Description Icon">
                            <path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-5-6zM13 3.5L17.5 8H13V3.5zM6 4h7v6h6v10H6V4z"/>
                            </svg>
                             <span class="text-sm text-gray-500">{{ job.description }}</span>
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full" v-for="skills in job.job_skills" :key="skills.id">{{ skills.skill.name}}</span>
                        </div>
                        <p class="text-right text-xs text-gray-500 mt-4"> {{ formatTimeAgo(job.created_at) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
