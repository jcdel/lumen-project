<template>
    <div class="edit-post">
        <EditPostComponent />
    </div>
</template>

<script>
    import EditPostComponent from '@/components/post/EditPost';

    export default {
        name: 'EditPost',
        components: {
            EditPostComponent
        }
    }
</script>