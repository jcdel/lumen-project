import httpService from '../../../services/common/httpService';

export default {

    getComments: (context, post_id) => {

        return new Promise((resolve, reject) => {

            httpService.get('posts/' + post_id + '/comments')
                .then(function (res) {

                    context.commit('SET_COMMENTS', res.data.data);
                    resolve(res);

                }).catch(function (err) {
                reject(err);
            });
        });
    },
    addComment: (context, comment) => {

        return new Promise((resolve, reject) => {
            httpService.post('posts/' + comment.post_id + '/comments', {
                user_id: comment.user_id,
                text: comment.text
            })
                .then((res) => {
                    context.commit('ADD_COMMENT', res.data.data);
                    resolve(res);
                })
                .catch((err) => {
                    reject(err);
                });
        });
    },

};
