<template>
    <div class="post_list">
        <PostList />
    </div>
</template>

<script>
    import PostList from '@/components/post/PostList';

    export default {
        name: 'PostsList',
        components: {
            PostList
        }
    }
</script>