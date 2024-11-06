<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link} from "@inertiajs/vue3";


export default {
    name: "Index",
    components: {
        Head, AuthenticatedLayout, Link
    },

    props: ['users'],

}
</script>

<template>
    <Head title="Users"/>

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Users
            </h2>
        </template>
        <div class="py-12">
            <div v-if="users" class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <Link v-for="user in users.data" :href="route('user.posts.index', {user: user.id})" class="block bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <h2 class="text-xl mb-4">{{ user.name }}</h2>
                    <p class="mb-4">{{ user.email }}</p>
                </Link>
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<style scoped>

</style>
