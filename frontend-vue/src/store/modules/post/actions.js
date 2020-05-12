import httpService from '@/services/common/httpService';

export default {

    async getPosts(context, page){
        try {
            const result = await httpService.get('posts?page=' + page);
            context.commit('SET_POSTS', result.data);

            return Promise.resolve(result);
        } catch(err) {
            return Promise.reject(err);
        }
    },

    async getPostsByUser(context, page){
        try {
            const result = await httpService.get('posts/me?page=' + page);
            context.commit('SET_USER_POSTS', result.data);

            return Promise.resolve(result);
        } catch(err) {
            return Promise.reject(err);
        }
    },

    async addPost(context, post){
        try {
            const result = await httpService.post('posts', {
                user_id: post.user_id,
                title: post.title,
                image: post.image,
                text: post.text,
            });
            context.dispatch('getPhoto');

            return Promise.resolve(result);
        } catch(err) {
            return Promise.reject(err.response.data);
        }
    },

    async getPhoto(context){
        try {
            const result = await httpService.getPhoto();
            context.commit('SET_PHOTO', result.data);

            return Promise.resolve(result);
        } catch(err) {
            return Promise.reject(err);
        }
    },

    async updatePost(context, post){
        try {
            const result = await  httpService.put('posts/' + post.id, {
                title: post.title,
                text: post.text,
                image: post.image,
            });
            context.commit('SET_POST', result.data.data);

            return Promise.resolve(result);
        } catch(err) {
            return Promise.reject(err.response.data);
        }
    },

    async getPost(context, post_id){
        try {
            const result = await httpService.get('posts/' + post_id);
            context.commit('SET_POST', result.data.data);

            return Promise.resolve(result);
        } catch(err) {
            return Promise.reject(err.response.data);
        }
    },

    async deletePost(context, post_id){
        try {
            const result = await httpService.delete('posts/' + post_id);
            context.commit('DELETE_POST', post_id);

            return Promise.resolve(result);
        } catch(err) {
            return Promise.reject(err);
        }
    },
};
