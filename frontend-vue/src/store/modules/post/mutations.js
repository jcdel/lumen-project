
export default {

    SET_POSTS: (state, posts) => {
        state.allPosts = Object.assign({}, posts);
    },
    SET_USER_POSTS: (state, posts) => {
        state.userPosts = Object.assign({}, posts);
    },
    SET_POST: (state, post) => {
        state.post = Object.assign({}, post);
    },
    DELETE_POST: (state, id) => {
        const userPosts = state.userPosts.data;
        state.userPosts.data = userPosts.filter(function (post) {
            return post.id != id;
        });
    }
};
