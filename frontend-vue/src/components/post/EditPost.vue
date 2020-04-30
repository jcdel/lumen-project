<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="" name="post-edit" v-on:submit.prevent="onUpdate">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" :value="post.title" id="title" @input="updatePostTitle"
                               class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="post_text">Text</label>
                        <textarea class="form-control" rows="25" cols="5" @input="updatePostText" id="post_text" v-model="post.text"></textarea>
                    </div>
                    <span class="red" v-if="error_permission">{{ error_permission }}</span>
                    <span class="green" v-if="success_update">Post successfully updated!</span>
                    <button type="submit" name="submit" class="btn-primary">Update</button>
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
                error_permission: '',
                success_update: false
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
                this.updatePost(this.updatedPost).then(() => {
                    this.success_update = true;
                }).catch((data) => {
                    if (data.error) {
                        this.error_permission = data.error;
                    }
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
    .red {
        color: red;
        display: inline-block;
        width: 100%;
    }
    .green {
        color: green;
        display: inline-block;
        width: 100%;
    }

</style>