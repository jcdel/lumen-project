<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <form action="" name="post-edit" v-on:submit.prevent="onUpdate">
                    <p v-if="errors.length">
                        <b>Please correct the following error(s):</b>
                        <ul>
                            <li class="alert alert-danger" role="alert" v-for="error in errors" v-bind:key="error" v-bind:error="error">{{ error }}</li>
                        </ul>
                    </p>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" :value="single_post.title" @input="updatePostTitle"
                               class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <select :value="single_post.image" class="form-control" id="image" @input="updatePostImage">
                            <option disabled value="">Please select one</option>
                            <option v-for="photo in photos" :key="photo.id" v:bind="photo.download_url">
                                {{ photo.download_url }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="post_text">Text</label>
                        <textarea class="form-control" rows="10" cols="5" @input="updatePostText" id="text" :value="single_post.text"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapState} from 'vuex';

    export default {

        name: 'EditPost',
        data() {
            return {
                updatedPost: {
                    title: '',
                    image: '',
                    text: ''
                },
                 errors: [],
            }
        },
        computed: {
            ...mapState('post', ['single_post', 'photos']),
        },
        created() {
            const postId = this.$route.params.id;
            this.getPost(postId);
            this.getPhoto();
        },
        methods: {
            getPost(id) {
                this.$store.dispatch('post/getPost', id);
            },
            getPhoto() {
                this.$store.dispatch('post/getPhoto');
            },

            ...mapActions('post', ['updatePost']),

            onUpdate() {

                const title = this.updatedPost.title;
                const text = this.updatedPost.text;
                const image = this.updatedPost.image;

                this.updatedPost.title = title ? title :  this.single_post.title;
                this.updatedPost.text = text ? text :  this.single_post.text;
                this.updatedPost.image = image ? image :  this.single_post.image;
                this.updatedPost.id = this.$route.params.id;

                 if (this.title && this.image && this.text) {
                    return true;
                }

                this.errors = [];

                if (!this.updatedPost.title) {
                    this.errors.push('Title required.');
                }
                if (!this.updatedPost.image) {
                    this.errors.push('Image required.');
                }
                if (!this.updatedPost.text) {
                    this.errors.push('Text required.');
                }

                this.updatePost(this.updatedPost).then(() => {
                    this.$router.push({name: 'UserPostsList'});
                }).catch(() => {
                    //
                });
            },
            updatePostTitle(e) {
                this.updatedPost.title = e.target.value;
            },
            updatePostImage(e) {
                this.updatedPost.image = e.target.value;
            },
            updatePostText(e) {
                this.updatedPost.text = e.target.value;
            },
        },

    };
</script>

<style scoped>
    section {
        padding: 100px 0;
    }
</style>