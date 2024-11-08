<script>
export default {
    name: "Post",

    props: ['post', 'auth'],

    methods: {
        toggleLike(post) {
            axios.patch(route('post.like', {'post': post.id}))
                .then(res => {
                    post.is_liked = res.data.is_liked;
                    post.likes_count = res.data.likes_count;
                })
        },
    }
}
</script>

<template>
    <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
        <h2 class="text-xl mb-6">{{ post.title }}</h2>
        <img v-if="post.image_url" :src="post.image_url" :alt="post.title"
             class="mb-6">
        <p class="mb-4">{{ post.content }}</p>
        <p v-if="auth && auth.user.id !== post.user.id" class="text-sm">{{ post.user.name }}</p>

        <div class="flex items-center justify-between">
            <p class="text-gray-400 text-sm ">{{ post.date }}</p>
            <div class="flex items-center">
                <p class="text-gray-400 text-sm mr-3">{{ post.likes_count }}</p>
                <svg @click="toggleLike(post)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor"
                     :class="['size-8 stroke-red-700 cursor-pointer', post.is_liked ? 'fill-red-700' : 'fill-white']">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                </svg>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
