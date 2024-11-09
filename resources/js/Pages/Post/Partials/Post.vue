<script>

import RepostForm from "@/Pages/Post/Partials/RepostForm.vue";
import CommentForm from "@/Pages/Post/Partials/CommentForm.vue";
import CommentsList from "@/Pages/Post/Partials/CommentsList.vue";

export default {
    name: "Post",
    components: {CommentsList, CommentForm, RepostForm},

    props: ['post', 'auth'],
    emits: ["getNewComment"],

    data() {
        return {
            is_reposted: false,
            openCommentForm: false,
            showComments: false,
            comments: null,
        }
    },

    methods: {
        toggleLike(post) {
            axios.patch(route('post.like', {'post': post.id}))
                .then(res => {
                    post.is_liked = res.data.is_liked;
                    post.likes_count = res.data.likes_count;
                })
        },

        toggleRepostForm() {
            if (this.auth && this.auth.user.id !== this.post.user.id)
                this.is_reposted = !this.is_reposted
        },

        getComments(){
            axios.get(route('post.commentsList', {post: this.post.id}))
                .then(res => {
                    this.comments = res.data.data;
                })
        },

        getNewComment(comment){
            console.log(comment);
            this.showComments = true;
        }

    },

    watch: {
        showComments(newShowComments, oldShowComments) {
            if (newShowComments) this.getComments();
        }
    },
}
</script>

<template>
    <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
        <h2 class="text-xl mb-6">{{ post.title }}</h2>
        <img v-if="post.image_url" :src="post.image_url" :alt="post.title"
             class="mb-6">
        <p class="mb-4">{{ post.content }}</p>

        <div v-if="post.reposted_post" class="bg-gray-100 p-8 rounded-2xl mb-4">
            <h2 class="text-xl mb-6">{{ post.reposted_post.title }}</h2>
            <img v-if="post.reposted_post.image_url" :src="post.reposted_post.image_url" :alt="post.reposted_post.title"
                 class="mb-6">
            <p class="mb-4">{{ post.reposted_post.content }}</p>
            <p class="text-sm">{{ post.reposted_post.user.name }}</p>
        </div>

        <p v-if="auth && auth.user.id !== post.user.id" class="text-sm">{{ post.user.name }}</p>
        <div class="flex items-center">
            <p class="text-gray-400 text-sm ">{{ post.date }}</p>
            <p @click="openCommentForm = !openCommentForm"
               class="ml-auto text-gray-400 text-sm mr-4 cursor-pointer hover:text-sky-500">
                {{ openCommentForm ? 'Close' : 'Add comment' }}
            </p>
            <p @click="showComments = !showComments" v-if="post.comments_count > 0"
               class="text-gray-400 text-sm mr-4 cursor-pointer hover:text-sky-500">
                {{ showComments ? 'Close comments' : 'Show comments' }}
            </p>
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
            <div class="flex items-center ml-3">
                <p class="text-gray-400 text-sm mr-3">0</p>
                <svg @click="toggleRepostForm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor"
                     :class="['size-6 cursor-pointer hover:stroke-sky-500', is_reposted ? 'stroke-sky-500' : '']">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z"/>
                </svg>
            </div>
        </div>
        <RepostForm v-if="is_reposted" :post_id="post.id" class="max-w-xl"/>
        <CommentForm v-if="openCommentForm" :post_id="post.id"/>
        <CommentsList v-if="comments && showComments" :comments="comments" @getNewComment="getNewComment"/>
    </div>
</template>

<style scoped>

</style>
