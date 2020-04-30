<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="" name="post-edit" v-on:submit.prevent="onAddPost">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" v-model="newPost.title" id="title"
                               class="form-control"/>
                    </div>
                     <div class="form-group">
                        <label for="image">Image Link</label>
                        <input type="text" v-model="newPost.image" id="image"
                               class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="post_text">Text</label>
                        <textarea class="form-control" rows="25" cols="5" v-model="newPost.text" id="post_text"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn-primary">Create</button>
                </form>

            </div>

        </div>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex';

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
            }
        },
        computed: {
            ...mapGetters('auth', ['getAuthenticatedUser']),
        },
        methods: {

            ...mapActions('post', ['addPost']),
            onAddPost() {
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