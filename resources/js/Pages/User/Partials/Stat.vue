<script>
export default {
    name: "Stat",

    props: ['stats'],
}
</script>

<template>
    <div class="flex justify-between items-center max-w-xl text-center mx-auto">
        <div>
            Subscribers <p>{{ stats.subscribers_count }}</p>
        </div>
        <div>
            Follow <p>{{ stats.followings_count }}</p>
        </div>
        <div>
            Likes <p>{{ stats.likes_count }}</p>
        </div>
        <div>
            Posts <p>{{ stats.posts_count }}</p>
        </div>
    </div>
</template>

<style scoped>

</style>
