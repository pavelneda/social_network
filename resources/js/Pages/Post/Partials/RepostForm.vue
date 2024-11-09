<script>
import {useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
    name: "RepostForm",
    components: {PrimaryButton, InputError, TextInput, InputLabel},

    props: ['post_id'],

    data() {
        return {
            form: useForm({
                title: '',
                content: '',
            }),
        }
    },

}
</script>

<template>
    <form
        @submit.prevent="form.post(route('post.repost', {post: post_id}),{
                              preserveScroll: true,
                              onSuccess: () => {
                                  form.reset();
                              },
                            })"
        class="mt-6 space-y-6"
    >
        <div>
            <InputLabel for="title" value="Title"/>

            <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.title"
                required
                autofocus
                autocomplete="title"
            />

            <InputError class="mt-2" :message="form.errors.title"/>
        </div>

        <div>
            <InputLabel for="content" value="Content"/>

            <textarea
                class="mt-1 block w-full resize-none rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                v-model="form.content"
                required
                rows="5"
            >
                </textarea>

            <InputError class="mt-2" :message="form.errors.content"/>
        </div>

        <div class="flex items-center gap-4">
            <PrimaryButton :disabled="form.processing">Repost</PrimaryButton>

            <Transition
                enter-active-class="transition ease-in-out"
                enter-from-class="opacity-0"
                leave-active-class="transition ease-in-out"
                leave-to-class="opacity-0"
            >
                <p
                    v-if="form.recentlySuccessful"
                    class="text-sm text-gray-600"
                >
                    Reposted.
                </p>
            </Transition>
        </div>
    </form>
</template>

<style scoped>

</style>
