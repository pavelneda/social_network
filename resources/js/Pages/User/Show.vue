<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import Post from "@/Pages/Post/Partials/Post.vue";
import Stat from "@/Pages/User/Partials/Stat.vue";


export default {
    name: "Show",
    components: {
        Post, Stat,
        Head, AuthenticatedLayout
    },

    props: ['posts', 'userName', 'auth', 'stats'],

}
</script>

<template>
    <Head title="My Posts"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800"
                >
                    {{ userName ?? 'User' }} posts
                </h2>
                <Stat v-if="stats" :stats="stats" class="w-full"></Stat>
            </div>
        </template>

        <div class="py-12">
            <div v-if="posts" class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <Post v-for="post in posts.data" :post="post" :auth="auth"/>
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<style scoped>

</style>
