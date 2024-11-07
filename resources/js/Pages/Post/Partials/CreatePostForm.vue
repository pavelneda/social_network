<script>
import {Link, router, useForm} from "@inertiajs/vue3";
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
                image_id: null,
            }),

            image: null,
            imageErrors: null,

        }
    },

    methods: {
        setFile() {
            this.$refs.image.click();
        },

        storeFile(e) {
            console.log(11111);
            const file = e.target.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('image', file);

            axios.post(route('postImage.store'), formData)
                .then(res => {
                    this.image = res.data;
                    this.imageErrors = null;
                })
                .catch(err => {
                    this.imageErrors = err.response.data.message;
                })
        },
    },

    watch: {
        image(newImage, oldImage) {
            const imageId = newImage ? newImage.id : null;
            this.form.image_id = imageId;
        }
    },
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
                              onSuccess: () => {
                                  form.reset();
                                  image = null;
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

            <div>
                <InputLabel for="image" value="Image"/>
                <input @change="storeFile" @click="$event.target.value=''" type="file" name="image" class="hidden" ref="image">
                <div class="flex">
                    <SecondaryButton @click.prevent="setFile">Load</SecondaryButton>
                    <SecondaryButton @click.prevent="this.image = null" v-if="image" class="ml-2 !bg-red-500">Cansel</SecondaryButton>
                </div>
                <InputError class="mt-2" :message="imageErrors"/>
                <div v-if="image" class="mt-3">
                    <img :src="image.url" alt="preview_image" class="rounded-2xl">
                </div>
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
