<script>
import {Link, useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

export default {
    name: "CreatePostForm",
    components: {SecondaryButton, PrimaryButton, InputError, Link, TextInput, InputLabel},


    data() {
        return {
            form: useForm({
                title: '',
                content: '',
            }),

            formImage: useForm({
                image: null,
            }),
        }
    },

    methods: {
        setFile(){
            this.$refs.image.click();
        },

        storeFile(e){
            this.formImage.image = e.target.files[0];
            this.formImage.post(route('postImage.store'))
        },
    }
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                New post
            </h2>
        </header>

        <form
            @submit.prevent="form.post(route('post.store'),{
                              preserveScroll: true,
                              onSuccess: () => form.reset(),
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

            <div>
                <InputLabel for="image" value="Image"/>
                <input @change="storeFile" type="file" name="image" class="hidden" ref="image">
                <SecondaryButton @click.prevent="setFile">Load</SecondaryButton>
                <InputError class="mt-2" :message="formImage.errors.image"/>
            </div>


            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Create</PrimaryButton>

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
                        Created.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>

<style scoped>

</style>
