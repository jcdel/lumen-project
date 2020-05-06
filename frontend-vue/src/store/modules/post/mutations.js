
export default {

    SET_POSTS: (state, posts) => {
        state.all_posts = Object.assign({}, posts);
    },
    SET_USER_POSTS: (state, posts) => {
        state.user_posts = Object.assign({}, posts);
    },
    SET_POST: (state, post) => {
        state.single_post = Object.assign({}, post);
    },
    SET_PHOTO: (state, photos) => {
        state.photos = Object.assign({}, photos);
    },
    DELETE_POST: (state, id) => {
        const user_posts = state.user_posts.data;
        state.user_posts.data = user_posts.filter(function (post) {
            return post.id != id;
        });
    },
};
