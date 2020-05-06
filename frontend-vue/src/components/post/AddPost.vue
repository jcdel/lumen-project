<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <form action="" name="post-edit" v-on:submit.prevent="onAddPost">
                    <p v-if="errors.length">
                        <b>Please correct the following error(s):</b>
                        <ul>
                            <li class="alert alert-danger" role="alert" v-for="error in errors" v-bind:key="error" v-bind:error="error">{{ error }}</li>
                        </ul>
                    </p>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" v-model="newPost.title" id="title"
                               class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <select v-model="newPost.image" class="form-control" id="selectPhoto">
                            <option disabled value="">Please select one</option>
                            <option v-for="photo in photos" :key="photo.id" v:bind="photo.download_url">
                                {{ photo.download_url }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="post_text">Text</label>
                        <textarea class="form-control" rows="7" cols="5" v-model="newPost.text" id="post_text"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters,mapActions,mapState} from 'vuex';

    export default {

        name: 'AddPost',
        data() {
            return {
                newPost: {
                    user_id: '',
                    title: '',
                    image: '',
                    text: ''
                },
                errors: [],
            }
        },
        computed: {
            ...mapGetters('auth', ['getAuthenticatedUser']),
            ...mapState('post', ['photos'])
        },
        created () {
            this.getPhoto();
        },
        methods: {
            getPhoto() {
                this.$store.dispatch('post/getPhoto');
            },
            ...mapActions('post', ['addPost']),
            onAddPost() {

                if (this.title && this.text && this.image) {
                    return true;
                }

                this.errors = [];

                if (!this.newPost.title) {
                    this.errors.push('Title required.');
                }
                if (!this.newPost.image) {
                    this.errors.push('Image required.');
                }
                if (!this.newPost.text) {
                    this.errors.push('Text required.');
                }

                this.newPost.user_id = this.getAuthenticatedUser.id;
                this.addPost(this.newPost).then(() => {
                    this.$router.push({name: 'UserPostsList'});
                 });
            },

        },

    };
</script>

<style scoped>
    section {
        padding: 100px 0;
    }
</style>