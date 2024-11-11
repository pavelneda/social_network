<script>
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";

export default {
    name: "CommentForm",
    components: {InputError, TextInput},

    props: ['post_id', 'replyComment'],

    data() {
        return {
            body: '',
            errors: null,
            comment: null,
        }
    },


    methods: {
        store() {
            axios.post(route('post.comment', {post: this.post_id}), {
                body: this.body,
                parent_id: this.replyComment ? this.replyComment.id : null
            })
                .then(res => {
                    this.comment = res.data.data;
                    this.body = '';
                    this.sendCommentToParent();
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                })
        },

        sendCommentToParent() {
            this.$emit('getNewComment', this.comment)
        },

    },


}
</script>

<template>
    <form @submit.prevent="store"
          class="mt-6 space-y-6">
        <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
            <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                <label for="comment" class="sr-only">Your comment</label>
                <textarea id="comment" rows="4"
                          class="resize-none w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                          placeholder="Write a comment..."
                          required
                          v-model="body"
                ></textarea>
                <InputError v-if="errors && errors.body" v-for="error in errors.body" class="mt-2" :message="error"/>
            </div>
            <div class="flex items-center px-3 py-2 border-t dark:border-gray-600">
                <button type="submit"
                        class="inline-flex items-center mr-4 py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                    Post comment
                </button>
                <div v-if="replyComment" class="text-sm flex">
                    <div class="mr-2">
                        Reply to <span class="text-blue-600">{{ replyComment.user.name }}</span>
                    </div>
                    <div @click="$emit('canselReply')" class="text-red-500 cursor-pointer">Cancel</div>
                </div>
                <Transition class="ml-auto"
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                >
                    <p
                        v-if="comment"
                        class="text-sm text-gray-600"
                    >
                        Commented.
                    </p>
                </Transition>
            </div>
        </div>
    </form>

</template>

<style scoped>

</style>
