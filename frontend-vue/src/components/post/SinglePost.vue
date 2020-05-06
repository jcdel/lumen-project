<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-content">
                    <div class="card-img">
                        <img v-bind:src="single_post.image">
                    </div>
                    <div class="card-desc">
                        <span class="text-muted"><i class="fa fa-clock"></i> {{ single_post.created_at }} by</span><strong> {{ single_post.author_name }}</strong>
                        <h1>{{ single_post.title }}</h1>
                        <p>{{ single_post.text }}</p>

                    </div>
                </div>
            </div>
            <CommentList :post_id="single_post.id"></CommentList>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import CommentList from '@/components/comment/CommentList.vue';

    export default {
        name: 'SinglePost',
        computed: {
            ...mapState('post', ['single_post']),
        },
        created() {
            const postId = this.$route.params.id;
            this.getPost(postId);
        },
        methods: {
            getPost(id) {
                this.$store.dispatch('post/getPost', id);
            },
        },
        components: {
            CommentList
        },

    };
</script>

<style scoped>
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
        top: 5%;
        left: 10%;
        background: #1ABC9C;
        padding: 6px;
        color: #fff;
        font-size: 16px;
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
        padding: 1.25rem;
    }


    .card-desc p {
        text-align: left;
        font-size: 15px;
        line-height: 26px;
    }


</style>