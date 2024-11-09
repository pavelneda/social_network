<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import Post from "@/Pages/Post/Partials/Post.vue";


export default {
    name: "Feed",
    components: {
        Post,
        Head, AuthenticatedLayout
    },

    props: ['posts', 'auth'],

}
</script>

<template>
    <Head title="Feed"/>

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Feed
            </h2>
        </template>
        <div class="py-12">
            <div v-if="posts" class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <Post v-for="post in posts.data" :post="post" :auth="auth" />
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<style scoped>

</style>
