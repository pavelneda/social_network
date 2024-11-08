<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import Post from "@/Components/Post.vue";


export default {
    name: "Index",
    components: {
        Post,
        Head, AuthenticatedLayout
    },

    props: ['posts', 'userName'],

}
</script>

<template>
    <Head title="My Posts"/>

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                {{ userName ?? 'User' }} posts
            </h2>
        </template>
        <div class="py-12">
            <div v-if="posts" class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <Post v-for="post in posts.data" :post="post" />
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<style scoped>

</style>
