<script>
export default {
    name: "Post",

    props: ['post']
}
</script>

<template>
    <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
        <h2 class="text-xl mb-6">{{ post.title }}</h2>
        <img v-if="post.image_url" :src="post.image_url" :alt="post.title"
             class="mb-6">
        <p class="mb-4">{{ post.content }}</p>
        <p class="text-gray-400 text-sm ">{{ post.date }}</p>
    </div>
</template>

<style scoped>

</style>
