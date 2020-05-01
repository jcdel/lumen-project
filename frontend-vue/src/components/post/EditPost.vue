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
                        <input type="text" id="title" v-model="post.title" @input="updatePostTitle"
                               class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="post_text">Text</label>
                        <textarea class="form-control" rows="10" cols="5" @input="updatePostText" id="post_text" v-model="post.text"></textarea>
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
                    text: ''
                },
                 errors: [],
            }
        },
        computed: {
            ...mapState('post', ['post'])
        },
        created() {
            const postId = this.$route.params.id;
            this.getPost(postId);
        },
        methods: {
            getPost(id) {
                this.$store.dispatch('post/getPost', id);
            },
            ...mapActions('post', ['updatePost']),
            onUpdate() {

                this.updatedPost.title = this.updatedPost.title ? this.updatedPost.title : this.post.title;
                this.updatedPost.text = this.updatedPost.text ? this.updatedPost.text : this.post.text;
                this.updatedPost.id = this.$route.params.id;

                 if (this.title && this.text) {
                    return true;
                }

                this.errors = [];

                if (!this.updatedPost.title) {
                    this.errors.push('Title required.');
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
            updatePostText(e) {
                this.updatedPost.text = e.target.value;
            }
        },

    };
</script>

<style scoped>
    section {
        padding: 100px 0;
    }
</style>