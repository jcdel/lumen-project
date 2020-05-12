import httpService from '@/services/common/httpService';

 export default {

    async getComments(context, post_id){
        try {
            const result = await httpService.get('posts/' + post_id + '/comments');
            context.commit('SET_COMMENTS', result.data);

            return Promise.resolve(result);
        } catch(err) {
            return Promise.reject(err);
        }
    },

    async addComment(context, comment){
        try {
            const result = await httpService.post('posts/' + comment.post_id + '/comments', {
                user_id: comment.user_id,
                text: comment.text
            });
            context.commit('ADD_COMMENT', result.data);

            return Promise.resolve(result);
        } catch(err) {
            return Promise.reject(err);
        }
    },

    async deleteComment(context, comment_id){
        try {
            const result = await httpService.delete('posts/' + comment_id +'/comments');
            context.commit('DELETE_COMMENT', comment_id);

            return Promise.resolve(result);
        } catch(err) {
            return Promise.reject(err);
        }
    },
};