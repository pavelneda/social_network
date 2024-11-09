<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import CreatePostForm from "@/Pages/Post/Partials/CreatePostForm.vue";


export default {
    name: "Create",
    components: {
        CreatePostForm,
        Head, AuthenticatedLayout
    },


}
</script>

<template>
    <Head title="Create Post"/>

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Create Post
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >

                    <h2 class="text-lg font-medium text-gray-900">
                        New post
                    </h2>
                    <CreatePostForm class="max-w-xl"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<style scoped>

</style>
