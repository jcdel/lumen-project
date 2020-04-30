<template>
    <div class="user_post_list">
        <UserPostsListComponent />
    </div>
</template>

<script>
    import UserPostsListComponent from '@/components/post/userPost/PostList';

    export default {
        name: 'UserPostsList',
        components: {
            UserPostsListComponent
        }
    }
</script>