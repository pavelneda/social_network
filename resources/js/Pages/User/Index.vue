<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";


export default {
    name: "Index",
    components: {
        PrimaryButton,
        Head, AuthenticatedLayout, Link
    },

    props: ['users'],

    methods: {
        toggleFollow(user) {
            axios.patch(route('user.follow', {'user': user.id}))
                .then(res => {
                    user.is_follow = res.data.is_follow;
                })
        },
    },

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
                <div v-for="user in users.data" class="flex items-center bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <Link :href="route('user.posts.index', {user: user.id})"
                          class="w-full">
                        <h2 class="text-xl mb-4">{{ user.name }}</h2>
                        <p class="mb-4">{{ user.email }}</p>
                    </Link>
                    <PrimaryButton @click.prevent="toggleFollow(user)"
                                   :class="user.is_follow ? '!bg-white !text-sky-500 !border !border-sky-500' :'!bg-sky-500'">
                        {{ user.is_follow ? 'Unfollow' : 'Follow' }}
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<style scoped>

</style>
