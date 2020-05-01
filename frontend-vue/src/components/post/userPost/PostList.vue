<template>

    <div class="container">

        <div class="col-md-12 user-posts ">
            <div v-for="post in userPosts.data" :key="post.id">


                <div class="row">
                    <div class="col-md-12 post-header-line text-left">
                        <i class="fa fa-clock"></i> {{ post.created_at }}
                    </div>
                </div>
                <div class="row post-content">
                    <div class="col-md-3">
                        <img :src="post.image ? post.image : no_image" width="200px">

                    </div>
                    <div class="col-md-9">
                        <h5><router-link :to="{ name: 'SinglePost', params: { id: post.id }}">{{ post.title }}</router-link></h5>
                        <p class="post-text">{{ post.text }}</p>
                        <div class="btns-block">
                            <router-link :to="{ name: 'SinglePost', params: { id: post.id }}">
                                <button type="button" class="btn btn-primary"> View </button>
                            </router-link>
                            <router-link :to="{ name: 'EditPost', params: { id: post.id }}">
                                <button type="button" class="btn btn-success"> Edit </button>
                            </router-link>
                            <button type="button" class="btn btn-danger" @click="onDelete(post.id)">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <pagination  :data="userPosts" @pagination-change-page="loadPosts"></pagination>
    </div>
</template>

<script>
    import {mapActions, mapState} from 'vuex';
    import pagination from 'laravel-vue-pagination';

    export default {
        name: 'UserPostList',

        data() {
            return {
                no_image: require('../../../assets/no_image.jpg')
            }
        },
        computed: {
            ...mapState('post', ['userPosts'])
        },
        methods: {
            ...mapActions({
                deletePost: 'post/deletePost',
            }),
            onDelete(post_id) {
                this.deletePost(post_id);
            },

             loadPosts(page = 1) {
                this.$store.dispatch('post/getPostsByUser',page);
            }
        },
        created: function () {
            this.$store.dispatch('post/getPostsByUser');
        },

        components: {
            pagination
        },

    };
</script>

<style scoped>
    @import url('https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto+Condensed:400,400i,700,700i');

    section {
        padding: 100px 0;
    }

    .post-content .btn {
        width: 150px;
        cursor: pointer;
        margin: 5px;
    }

    .post-content .btn a {
        color: white;
    }

    .post-content img {
        margin: 50px 0 20px 0;
        width: 100%;
    }

    .btns-block {
        float: right;
        margin-bottom: 15px;
    }

    .user-posts {
        margin: 10px 0 10px 0;
        background: #ffffff;
        border: 4px;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
    }

    .post-header-line {
        border-top: 1px solid #DDD;
        border-bottom: 1px solid #DDD;
        padding: 5px 0px 5px 15px;
        font-size: 12px;
    }

    .post-text {
        text-align: left;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
    }


</style>