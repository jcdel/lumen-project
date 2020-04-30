<template>
    <div class="add-post">
        <AddPostComponent />
    </div>
</template>

<script>
    import AddPostComponent from '@/components/post/AddPost';

    export default {
        name: 'AddPost',
        components: {
            AddPostComponent
        }
    }
</script>