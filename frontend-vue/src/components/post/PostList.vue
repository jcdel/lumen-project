<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3" v-for="post in allPosts.data" :key="post.id">
                <div class="card-content">
                    <div class="card-img">
                        <img :src="post.image">
                    </div>
                    <div class="card-desc">
                        <div class="small m-b-xs text-left">
                            <strong>{{ post.author_name }}</strong> <span class="text-muted"><i class="fa fa-clock-o"></i> {{ post.created_at }}</span>
                        </div>
                        <h3><router-link :to="{ name: 'SinglePost', params: { id: post.id }}">{{ post.title }}</router-link></h3>
                        <p class="post-text">{{ post.text }}</p>
                    </div>
                </div>
            </div>
            <pagination  :data="allPosts" @pagination-change-page="loadPosts"></pagination>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import pagination from 'laravel-vue-pagination';

    export default {
        name: 'PostList',
        computed: {
            ...mapState('post', ['allPosts']),
        },
        methods: {
            loadPosts(page = 1) {
                this.$store.dispatch('post/getPosts',page);
            }
        },
        created : function() {
            this.$store.dispatch('post/getPosts');
        },
        components: {
            pagination
        },
    };
</script>

<style scoped>
    @import url('https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Roboto+Condensed:400,400i,700,700i');
    section{
        padding: 100px 0;
    }

    .card-content {
        margin: 10px 0 10px 0;
        background: #ffffff;
        border: 4px;
        box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    }

    .card-img {
        position: relative;
        overflow: hidden;
        border-radius: 0;
        z-index: 1;
    }

    .card-img img {
        width: 100%;
        height: auto;
        display: block;
    }

    .card-img span {
        position: absolute;
        top: 20%;
        left: 12%;
        background: #1ABC9C;
        padding: 2px;
        color: #fff;
        font-size: 12px;
        border-radius: 4px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms-border-radius: 4px;
        -o-border-radius: 4px;
        transform: translate(-50%,-50%);
    }
    .card-img span h4{
        font-size: 12px;
        margin:0;
        padding:10px 5px;
        line-height: 0;
    }
    .card-desc {
        padding: 0.5rem;
    }

    .card-desc h3 {
        display: inline-block;
        color: #000000;
        font-weight: 600;
        font-size: 12px;
        line-height: 1em;
        margin-top: 0;
        margin-bottom: 5px;
        padding: 0;
    }

    .card-desc p {
        color: #747373;
        text-align: left;
        font-size: 12px;
        font-weight: 400;
        line-height: 1.3;
        margin: 0px;
        padding: 0;
        font-family: 'Raleway', sans-serif;
    }
    .post-text {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
    }


</style>