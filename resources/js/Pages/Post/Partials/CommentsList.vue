<script>
export default {
    name: "CommentsList",

    props: ['comments']
}
</script>

<template>
    <article v-for="comment in comments" class="mt-8 text-base bg-white rounded-lg dark:bg-gray-900">
        <div class="flex items-center mb-2">
            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                {{ comment.user.name }}
            </p>
            <p class="text-sm text-gray-400 dark:text-gray-400">
                {{ comment.date }}
            </p>
        </div>
        <p class="text-gray-500 dark:text-gray-400">{{ comment.body }}</p>
        <div class="flex items-center mt-4 space-x-4">
            <button type="button"
                    class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 20 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                </svg>
                Reply
            </button>
        </div>
    </article>

</template>

<style scoped>

</style>
