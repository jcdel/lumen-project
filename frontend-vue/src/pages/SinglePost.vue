<template>
    <div class="single-post">
        <SinglePostComponent />
    </div>
</template>

<script>
    import SinglePostComponent from '@/components/post/SinglePost';

    export default {
        name: 'SinglePost',
        components: {
            SinglePostComponent
        }
    }
</script>