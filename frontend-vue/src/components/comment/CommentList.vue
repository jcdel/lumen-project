<template>

    <div class="col-sm-12">
        <div class="comments-block">
            <div v-for="comment in comments.data" :key="comment.id">
                <div class="single-post text-left">
                    <span class="font-weight-bold author-name">{{ comment.author_name }}</span>
                    {{ comment.created_at }}
                    <p>{{ comment.text }}</p>
                    <span><button type="button" class="btn btn-danger" @click="onDelete(comment.id)">
                        Delete
                    </button></span>
                </div>
            </div>
            <p v-if="errors.length">
                <b>Please correct the following error(s):</b>
                <ul>
                    <li class="alert alert-danger" role="alert" v-for="error in errors" v-bind:key="error" v-bind:error="error">{{ error }}</li>
                </ul>
            </p>
            <div class="new-comment-block">
                <h3 class="text-center">Leave a Comment</h3>
                <textarea v-model="newComment.text" placeholder="Write a comment"></textarea>
                <button @click="onAddComment" class="btn btn-primary">Submit</button>
            </div>

        </div>
    </div>

</template>

<script>

    import {mapGetters, mapActions, mapState} from 'vuex';

    export default {
        name: 'CommentList',
        data: function () {
            return {
                newComment: {
                    user_id: null,
                    post_id: null,
                    text: ''
                },
                errors: [],
            };
        },
        computed: {
            ...mapState('comment', ['comments']),
            ...mapGetters('auth', ['getAuthenticatedUser']),
        },
        created: function () {
            const postId = this.$route.params.id;
            this.getComments(postId);
        },
        methods: {
            getComments(postId) {
                this.$store.dispatch('comment/getComments', postId);
            },
             onDelete(commentId) {
                this.deleteComment(commentId);
            },
            ...mapActions('comment', ['addComment']),
            ...mapActions({
                deleteComment: 'comment/deleteComment',
            }),
            onAddComment() {

                if (this.text) {
                    return true;
                }
                this.errors = [];

                if (!this.newComment.text) {
                    this.errors.push('Comment required.');
                }
                this.newComment.user_id = this.getAuthenticatedUser.id;
                this.newComment.post_id = this.$route.params.id;
                this.addComment(this.newComment).then(() => {
                    this.clearCommentInput();
                });
            },
            clearCommentInput() {
                this.newComment.text = '';
            }
        },
    };
</script>

<style scoped>

    .comments-block {
        padding-left: 15px;
        margin-bottom: 10px;
        background: #ffffff;
        border: 4px;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
    }
    .comments-block h3 {
        font-weight: 100;
    }

    .new-comment-block {
        padding: 15px;
    }

    .new-comment-block textarea {
        width: 100%;
    }

    .author-name {
        margin-right: 10px;
    }
</style>