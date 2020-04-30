
export default {

    SET_COMMENTS: (state, comments) => {

        state.comments = Object.assign({}, comments);
    },
    ADD_COMMENT: (state, comment) => {
        let newComment = {};
        newComment[comment.id] = comment;
        state.comments = Object.assign(
            {},
            state.comments,
            newComment
        );
    },
};
