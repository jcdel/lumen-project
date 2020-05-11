
export default {

    SET_COMMENTS: (state, comments) => {
        state.comments = Object.assign({}, comments);
    },
    ADD_COMMENT: (state, comment) => {
        
        let newComment = {};
        newComment[comment.data.id] = comment.data;
        state.comments.data = Object.assign(
            {},
            state.comments.data,
            newComment
        );
    },
    DELETE_COMMENT: (state, id) => {

        const comments = state.comments.data;
        state.comments.data = comments.filter(function (comment) {
            return comment.id != id;
        });
    }
};
